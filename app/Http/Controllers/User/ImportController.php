<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\ImportHistory;
use App\Models\Pays;
use App\Models\User;

class ImportController extends Controller
{
    protected $excludedColumns = ['id', 'created_at', 'updated_at', 'pays_id'];
    protected $requiredFields = ['phone'];
    protected $optionalFields = ['gsm', 'address'];

    public function showMappingForm(Request $request)
    {
        $selectedTable = $request->input('table');
        $b2bColumns = $this->getTableColumns('b2b');
        $b2cColumns = $this->getTableColumns('b2c');
        $excelHeaders = [];
        return view('user.data.show', compact('b2bColumns', 'b2cColumns', 'excelHeaders'));
    }

    public function readExcelHeaders(Request $request, $pays, $type)
    {
        $validator = Validator::make($request->all(), [
            'file' => 'required|file|mimes:xlsx,csv|max:10240',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $file = $request->file('file');
            $excel = Excel::toArray([], $file);
            $excelHeaders = $excel[0][0] ?? [];

            $path = $file->store('temp');
            session(['temp_excel_file' => $path]);
            session(['original_filename' => $file->getClientOriginalName()]);

            $columns = $this->getTableColumns($type);
            $pays = Pays::where('name', $pays)->first();

            return view('user.data.show', [
                'type' => $type,
                'pays' => $pays,
                'pays_id' => $pays->id,
                'b2bColumns' => $type === 'b2b' ? $columns : [],
                'b2cColumns' => $type === 'b2c' ? $columns : [],
                'excelHeaders' => $excelHeaders,
            ]);
        } catch (\Exception $e) {
            return back()->withErrors(['file' => 'Error reading file: ' . $e->getMessage()]);
        }
    }

    public function processImport(Request $request)
{
    try {
        // Récupération des mappings
        $b2bMapping = $request->input('b2b_mapping', []);
        $b2cMapping = $request->input('b2c_mapping', []);
        $pays_id = $request->input('pays_id');
        $filename = session('original_filename');
        $filePath = storage_path('app/' . session('temp_excel_file'));

        $data = Excel::toArray([], $filePath)[0];
        $headers = array_shift($data);

        $skippedCount = 0;
        $importedCount = 0;

        DB::beginTransaction();

        foreach ($data as $row) {
            $b2bResult = $this->processRow($row, $b2bMapping, 'b2b', $pays_id);
            $b2cResult = $this->processRow($row, $b2cMapping, 'b2c', $pays_id);

            // Compter les ignorés et les insérés
            $skippedCount += $b2bResult['skipped'] + $b2cResult['skipped'];
            $importedCount += $b2bResult['imported'] + $b2cResult['imported'];
        }

        // Stocker l'historique de l'import
        ImportHistory::create([
            'pays_id' => $pays_id,
            'user_id' => Auth::id(),
            'filename' => $filename,
            'total_records' => count($data),
            'imported_records' => $importedCount,
            'skipped_records' => $skippedCount,
            'status' => 'completed',
        ]);

        DB::commit();

        // Nettoyer le fichier temporaire
        if (file_exists($filePath)) {
            unlink($filePath);
        }
        session()->forget(['temp_excel_file', 'original_filename']);

        return redirect()->route('dashboard')
            ->with('success', "Importation terminée. $importedCount enregistrements importés, $skippedCount ignorés.");
    } catch (\Exception $e) {
        DB::rollBack();

        // Ajouter une entrée d'historique pour l'erreur
        ImportHistory::create([
            'pays_id' => $pays_id,
            'user_id' => Auth::id(),
            'filename' => session('original_filename'),
            // 'status' => 'failed',
            'error_message' => $e->getMessage(),
        ]);

        // Nettoyer les sessions temporaires
        session()->forget(['temp_excel_file', 'original_filename']);

        return back()->withErrors(['import' => 'Erreur lors de l\'importation : ' . $e->getMessage()]);
    }
}


    // p:ublic function history()
    // {
    //     $history = ImportHistory::with('pays')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(20);

    //     return view('dashboard', compact('history'));
    // }

    protected function processRow($row, $mapping, $table, $pays_id)
{
    $imported = 0;
    $skipped = 0;

    if (empty($mapping)) {
        return ['imported' => $imported, 'skipped' => $skipped];
    }

    $data = $this->mapRowData($row, $mapping);
    if (empty($data['phone'])) {
        $skipped++;
        return ['imported' => $imported, 'skipped' => $skipped];
    }

    $exists = DB::table($table)
        ->where('phone', $data['phone'])
        ->where('pays_id', $pays_id)
        ->exists();

    if ($exists) {
        $skipped++;
    } else {
        $data['pays_id'] = $pays_id;
        $data['created_at'] = now();
        $data['updated_at'] = now();

        DB::table($table)->insert($data);
        $imported++;
    }

    return ['imported' => $imported, 'skipped' => $skipped];
}


    protected function mapRowData($row, $mapping)
    {
        $data = [];
        if (!is_array($mapping)) {
            return $data;
        }

        foreach ($mapping as $column => $index) {
            if (!empty($index) && isset($row[$index])) {
                $data[$column] = trim($row[$index]);
            }
        }

        return $data;
    }

    protected function getTableColumns($table)
    {
        return array_diff(
            Schema::getColumnListing($table),
            $this->excludedColumns
        );
    }
}