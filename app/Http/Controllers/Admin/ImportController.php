<?php

namespace App\Http\Controllers\Admin;

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
            $headers = array_shift($data);
            $type = !empty($b2bMapping) ? 'b2b' : 'b2c';
            $skippedCount = 0;
            $importedCount = 0;
    
            // Fetch existing phone numbers to optimize lookup
            $existingPhones = DB::table($type)
                ->where('pays_id', $pays_id)
                ->pluck('phone')
                ->toArray();
    
            DB::beginTransaction();
    
            foreach ($data as $row) {
                // Map data
                $rowData = $this->mapRowData($row, $type === 'b2b' ? $b2bMapping : $b2cMapping);
    
                if (empty($rowData['phone']) || in_array($rowData['phone'], $existingPhones)) {
                    $skippedCount++;
                    continue;
                }
    
                // Prepare row for insertion
                $rowData['pays_id'] = $pays_id;
                $rowData['created_at'] = now();
                $rowData['updated_at'] = now();
    
                // Insert into the table
                DB::table($type)->insert($rowData);
                $importedCount++;
    
                // Add to existing phones to prevent duplicates in the same batch
                $existingPhones[] = $rowData['phone'];
            }
    
            // Create ImportHistory entry
            ImportHistory::create([
                'pays_id' => $pays_id,
                'user_id' => Auth::id(),
                'filename' => $filename,
                'total_records' => count($data),
                'imported_records' => $importedCount,
                'skipped_records' => $skippedCount,
                'tag' => $this->generateTag($type, $pays_id),
            ]);
    
            DB::commit();
    
            // Clean up the temporary file
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            session()->forget(['temp_excel_file', 'original_filename']);
    
            return redirect()->route('admin.dashboard')
                ->with('success', "Import completed: $importedCount records imported, $skippedCount skipped.");
        } catch (\Exception $e) {
            DB::rollBack();
    
            // Create ImportHistory entry for errors
            ImportHistory::create([
                'pays_id' => $pays_id,
                'user_id' => Auth::id(),
                'filename' => session('original_filename'),
                'total_records' => isset($data) ? count($data) : 0,
                'imported_records' => 0,
                'skipped_records' => isset($skippedCount) ? $skippedCount : 0,
                'tag' => $this->generateTag($type ?? 'unknown', $pays_id),
                'error_message' => $e->getMessage(),
                'action'=>'import'
            ]);
    
            session()->forget(['temp_excel_file', 'original_filename']);
    
            return redirect()->route('admin.dashboard')
                ->withErrors(['import' => 'Error during import: ' . $e->getMessage()]);
        }
    }
    


    // p:ublic function history()
    // {
    //     $history = ImportHistory::with('pays')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(20);

    //     return view('dashboard', compact('history'));
    // }
    protected function generateTag($tableType, $pays_id)
    {
        $pays = DB::table('pays')->where('id', $pays_id)->value('name');
        $date = now()->format('Y-m-d');
        return "{$tableType}_{$pays}_{$date}";
    }

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