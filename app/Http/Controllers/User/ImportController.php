<?php

namespace App\Http\Controllers\User;

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
    protected $requiredFields = ['tel']; 
    protected $optionalFields = ['gsm', 'address']; 
    protected $insertedCount = 0;   
    protected $columnCount = 0;

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
            DB::beginTransaction();

            $pays_id = $request->input('pays_id');
            $filename = session('original_filename');
            $filePath = storage_path('app/' . session('temp_excel_file'));
            
            $data = Excel::toArray([], $filePath)[0];
            $headers = array_shift($data);

            $userName = Auth::check() ? Auth::user()->name : 'user';

            $this->insertedCount = 0;

            foreach ($data as $row) {
                $this->processRow($row, $request->b2b_mapping, $request->b2c_mapping, $pays_id);
            }

            if ($request->b2b_mapping) {
                ImportHistory::create([
                    'table_type' => 'b2b',
                    'pays_id' => $pays_id,
                    'user_name' => $userName,
                    'tag' => $request->input('tag', 'Import B2B'),
                    'action' => 'import',
                ]);
            }

            // Enregistrer l'historique pour B2C
            if ($request->b2c_mapping) {
                ImportHistory::create([
                    'table_type' => 'b2c',
                    'pays_id' => $pays_id,
                    'user_name' => $userName,
                    'tag' => $request->input('tag', 'Import B2C'),
                    'action' => 'import',
                ]);
            }

            DB::commit();
            
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            session()->forget(['temp_excel_file', 'original_filename']);

            return redirect()->route('dashboard')
                ->with('success', 'Import completed successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['import' => 'Import failed: ' . $e->getMessage()]);
        }
    }

    protected function processRow($row, $b2bMapping, $b2cMapping, $pays_id)
    {
        if ($b2bMapping) {
            $b2bData = $this->mapRowData($row, $b2bMapping);
            if (!empty($b2bData)) {
                $b2bData['pays_id'] = $pays_id;
                $b2bData['created_at'] = now();
                $b2bData['updated_at'] = now();
                DB::table('b2b')->insert($b2bData);
            }
        }

        if ($b2cMapping) {
            $b2cData = $this->mapRowData($row, $b2cMapping);
            if (!empty($b2cData)) {
                $b2cData['pays_id'] = $pays_id;
                $b2cData['created_at'] = now();
                $b2cData['updated_at'] = now();
                DB::table('b2c')->insert($b2cData);
            }
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

    public function history()
    {
        $history = ImportHistory::with('pays')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('user.data.import-history', compact('history'));
    }
}