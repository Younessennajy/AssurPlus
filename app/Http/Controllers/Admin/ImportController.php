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
use App\Jobs\ProcessImportJob;

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
        $b2bMapping = $request->input('b2b_mapping', []);
        $b2cMapping = $request->input('b2c_mapping', []);
        $pays_id = $request->input('pays_id');
        $filename = session('original_filename');
        $filePath = storage_path('app/' . session('temp_excel_file'));

        $data = Excel::toArray([], $filePath)[0];
        array_shift($data);

        // Déterminer le type basé sur les mappings
        $type = !empty($b2bMapping) ? 'b2b' : (!empty($b2cMapping) ? 'b2c' :null);

        // Créer une entrée dans l'historique
        $importHistory = ImportHistory::create([
            'pays_id' => $pays_id,
            'user_name' => Auth::user()->name,
            'tag' => $filename,
            'table_type' => $type,
            'action' => 'importer',
            'filename' => $filename,
            'total_records' => count($data),
            'imported_records' => 0,
            'skipped_records' => 0, 
        ]);

        ProcessImportJob::dispatch(
            $data,
            $b2bMapping,
            $b2cMapping,
            $pays_id,
            Auth::id(),
            $filename,
            $importHistory->id
        );

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        return redirect()->route('admin.import.history')
            ->with('success', 'Import lancé avec succès. Vous pouvez suivre la progression dans l\'historique des imports.');
    } catch (\Exception $e) {
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

    protected function processRow($data, $b2bMapping, $b2cMapping, $pays_id, $historyId)
    {
        $existingPhonesB2B = DB::table('b2b')
            ->where('pays_id', $pays_id)
            ->pluck('phone')
            ->toArray();
    
        $existingPhonesB2C = DB::table('b2c')
            ->where('pays_id', $pays_id)
            ->pluck('phone')
            ->toArray();
    
        $newB2BData = [];
        $newB2CData = [];
        $importedCount = 0;
        $skippedCount = 0;
    
        foreach ($data as $row) {
            if (!empty($b2bMapping)) {
                $b2bData = $this->mapRowData($row, $b2bMapping);
                if (!empty($b2bData['phone']) && !in_array($b2bData['phone'], $existingPhonesB2B)) {
                    $b2bData['pays_id'] = $pays_id;
                    $b2bData['created_at'] = now();
                    $b2bData['updated_at'] = now();
                    $newB2BData[] = $b2bData;
                    $existingPhonesB2B[] = $b2bData['phone'];
                    $importedCount++;
                } else {
                    $skippedCount++;
                }
            }
    
            // Traitement pour B2C
            if (!empty($b2cMapping)) {
                $b2cData = $this->mapRowData($row, $b2cMapping);
                if (!empty($b2cData['phone']) && !in_array($b2cData['phone'], $existingPhonesB2C)) {
                    $b2cData['pays_id'] = $pays_id;
                    $b2cData['created_at'] = now();
                    $b2cData['updated_at'] = now();
                    $newB2CData[] = $b2cData;
                    $existingPhonesB2C[] = $b2cData['phone'];
                    $importedCount++;
                } else {
                    $skippedCount++;
                }
            }
        }
    
        if (!empty($newB2BData)) {
            DB::table('b2b')->insert($newB2BData);
        }
        if (!empty($newB2CData)) {
            DB::table('b2c')->insert($newB2CData);
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