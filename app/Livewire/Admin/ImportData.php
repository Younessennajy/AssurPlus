<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;
use App\Models\ImportHistory;
use App\Models\Pays;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ImportData extends Component
{
    use WithFileUploads;

    public $file;
    public $pays;
    public $type;
    public $excelHeaders = [];
    public $b2bColumns = [];
    public $b2cColumns = [];
    public $b2bMapping = [];
    public $b2cMapping = [];
    public $temporaryFilePath;
    public $checkDuplicatesResult;
    protected $excludedColumns = ['id', 'created_at', 'updated_at', 'pays_id'];

    protected $rules = [
        'file' => 'required|file|mimes:xlsx,csv|max:10240',
    ];

    public function mount($pays = null, $type = null)
    {
        $this->pays = Pays::where('name', $pays)->first();
        $this->type = $type;
        $this->b2bColumns = $this->getTableColumns('b2b');
        $this->b2cColumns = $this->getTableColumns('b2c');
    }

    public function updatedFile()
    {
        $this->validate();

        try {
            $excel = Excel::toArray([], $this->file);
            $this->excelHeaders = $excel[0][0] ?? [];
            
            $this->temporaryFilePath = $this->file->store('temp');
        } catch (\Exception $e) {
            session()->flash('error', 'Error reading file: ' . $e->getMessage());
        }
    }

    public function processImport()
    {
        try {
            $allSelectedColumns = array_merge(
                array_values($this->b2bMapping), 
                array_values($this->b2cMapping)
            );
            $duplicates = array_diff_assoc($allSelectedColumns, array_unique($allSelectedColumns));

            if (!empty($duplicates)) {
                session()->flash('error', 'Certaines colonnes Excel sont mappées plusieurs fois.');
                return;
            }

            DB::beginTransaction();

            $data = Excel::toArray([], storage_path('app/' . $this->temporaryFilePath))[0];
            $headers = array_shift($data);

            foreach ($data as $row) {
                $this->processRow($row);
            }

            DB::commit();

            if (file_exists(storage_path('app/' . $this->temporaryFilePath))) {
                unlink(storage_path('app/' . $this->temporaryFilePath));
            }

            session()->flash('success', 'Import terminé avec succès.');
            return redirect()->route('admin.dashboard');

        } catch (\Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Erreur lors de l\'importation : ' . $e->getMessage());
        }
    }

    public function checkDuplicates()
    {
        try {
            $filePath = storage_path('app/' . $this->temporaryFilePath);
            if (!file_exists($filePath)) {
                session()->flash('error', 'Fichier Excel introuvable.');
                return;
            }

            $data = Excel::toArray([], $filePath)[0];
            $headers = array_shift($data);

            $phoneColumnIndex = array_search('phone', $headers);
            if ($phoneColumnIndex === false) {
                $this->checkDuplicatesResult = 'La colonne "phone" est manquante.';
                return;
            }

            $allPhones = array_column($data, $phoneColumnIndex);
            $duplicates = array_unique(array_diff_assoc($allPhones, array_unique($allPhones)));

            $this->checkDuplicatesResult = empty($duplicates) 
                ? 'Aucun doublon trouvé.' 
                : 'Doublons trouvés : ' . implode(', ', $duplicates);

        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la vérification : ' . $e->getMessage());
        }
    }

    protected function processRow($row)
    {
        if ($this->b2bMapping) {
            $b2bData = $this->mapRowData($row, $this->b2bMapping);
            if (!empty($b2bData)) {
                $b2bData['pays_id'] = $this->pays->id;
                $b2bData['created_at'] = now();
                $b2bData['updated_at'] = now();
                DB::table('b2b')->insert($b2bData);
            }
        }

        if ($this->b2cMapping) {
            $b2cData = $this->mapRowData($row, $this->b2cMapping);
            if (!empty($b2cData)) {
                $b2cData['pays_id'] = $this->pays->id;
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

    public function render()
    {
        return view('livewire.admin.import-data');
    }
}