<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ImportController extends Controller
{
    protected $excludedColumns = ['id', 'created_at', 'updated_at', 'pays_id'];
    protected $requiredFields = ['tel']; 
    protected $optionalFields = ['gsm', 'address']; 
    protected $insertedCount = 0;
    protected $cuolumnCount = 0;

    public function showMappingForm()
    {
        $selectedTable = $request->input('table');
        $b2bColumns = $this->getTableColumns('b2b');
        $b2cColumns = $this->getTableColumns('b2c');
        $excelHeaders = [];
        
        return view('admin.data.show', compact('b2bColumns', 'b2cColumns', 'excelHeaders'));
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
            
            $columns = $this->getTableColumns($type);
            $pays = \App\Models\Pays::where('name', $pays)->first();

            return view('admin.data.show', [
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
            session(['pays_id' => $pays_id]);
            

            $filePath = storage_path('app/' . session('temp_excel_file'));
            $data = Excel::toArray([], $filePath)[0];
            $headers = array_shift($data);

            $this->insertedCount = 0;

            foreach ($data as $row) {
                $this->processRow($row, $request->b2b_mapping, $request->b2c_mapping);
            }

            DB::commit();
            
            unlink($filePath);
            session()->forget('temp_excel_file');

            return redirect()->route('admin.dashboard')->with('success');
        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Import Error: ' . $e->getMessage());
            return back()->withErrors(['import' => 'Import failed: ' . $e->getMessage()]);
        }
    }

    protected function processRow($row, $b2bMapping, $b2cMapping)
    {
        $pays_id = session('pays_id');

        $b2bData = $this->mapRowData($row, $b2bMapping);
        

        // if ( isset($b2bData['tel'])) {
            $b2bData['pays_id'] = $pays_id;
            $b2bData['created_at'] = now();
            $b2bData['updated_at'] = now();
            DB::table('b2b')->insert($b2bData);
        // }

        $b2cData = $this->mapRowData($row, $b2cMapping);
        if (!empty($b2cData) && isset($b2cData['tel'])) {
            $b2cData['pays_id'] = $pays_id;
            $b2cData['created_at'] = now();
            $b2cData['updated_at'] = now();
            DB::table('b2c')->insert($b2cData);
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
                $data[$column] = $row[$index];
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