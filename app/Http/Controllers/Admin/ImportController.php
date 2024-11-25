<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\ImportHistory;
use App\Models\Pays;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        return view('livewire.admin.data.show', compact('b2bColumns', 'b2cColumns', 'excelHeaders'));
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

            return view('livewire.admin.data.show', [
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

            // Vérification des doublons
            // $allSelectedColumns = array_merge(array_values($b2bMapping), array_values($b2cMapping));
            // $duplicates = array_diff_assoc($allSelectedColumns, array_unique($allSelectedColumns));

            // if (!empty($duplicates)) {
            //     return back()->with('error', 'Certaines colonnes Excel sont mappées plusieurs fois. Veuillez corriger les doublons.');
            // }

            // Traitement normal de l'import
            DB::beginTransaction();
            $pays_id = $request->input('pays_id');
            $filename = session('original_filename');
            $filePath = storage_path('app/' . session('temp_excel_file'));

            $data = Excel::toArray([], $filePath)[0];
            $headers = array_shift($data);

            $userName = Auth::check() ? Auth::user()->name : 'admin';

            foreach ($data as $row) {
                $this->processRow($row, $b2bMapping, $b2cMapping, $pays_id);
            }

            DB::commit();

            if (file_exists($filePath)) {
                unlink($filePath);
            }
            session()->forget(['temp_excel_file', 'original_filename']);

            return redirect()->route('admin.dashboard')
                ->with('success', 'Import terminé avec succès.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['import' => 'Erreur lors de l\'importation : ' . $e->getMessage()]);
        }
    }

    public function history()
    {
        $history = ImportHistory::with('pays')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.admin.data.import-history', compact('history'));
    }

    protected function processRow($row, $b2bMapping, $b2cMapping, $pays_id)
    {
        if ($b2bMapping) {
            $b2bData = $this->mapRowData($row, $b2bMapping);
            // if (!empty($b2bData)) {
                $b2bData['pays_id'] = $pays_id;
                $b2bData['created_at'] = now();
                $b2bData['updated_at'] = now();
                DB::table('b2b')->insert($b2bData);
            // }
        }
    
        if ($b2cMapping) {
            $b2cData = $this->mapRowData($row, $b2cMapping);
            // if (!empty($b2cData)) {
                $b2cData['pays_id'] = $pays_id;
                $b2cData['created_at'] = now();
                $b2cData['updated_at'] = now();
                DB::table('b2c')->insert($b2cData);
            // }
        }
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
