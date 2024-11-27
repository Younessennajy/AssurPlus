<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Models\ImportHistory;
use Illuminate\Support\Facades\Auth;

class ProcessImportJobUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    protected $b2bMapping;
    protected $b2cMapping;
    protected $pays_id;
    protected $userId;
    protected $filename;

    public function __construct($data, $b2bMapping, $b2cMapping, $pays_id, $userId, $filename)
    {
        $this->data = $data;
        $this->b2bMapping = $b2bMapping;
        $this->b2cMapping = $b2cMapping;
        $this->pays_id = $pays_id;
        $this->userId = $userId;
        $this->filename = $filename;
    }

    public function handle()
    {
        try {
            DB::beginTransaction();

            // Récupérer les numéros existants
            $existingPhonesB2B = DB::table('b2b')
                ->where('pays_id', $this->pays_id)
                ->pluck('phone')
                ->toArray();
            
            $existingPhonesB2C = DB::table('b2c')
                ->where('pays_id', $this->pays_id)
                ->pluck('phone')
                ->toArray();

            $newB2BData = [];
            $newB2CData = [];
            $skippedCount = 0;
            $batchSize = 1000; 

            foreach ($this->data as $index => $row) {
                if (!empty($this->b2bMapping)) {
                    $b2bData = $this->mapRowData($row, $this->b2bMapping);
                    
                    if (!empty($b2bData['phone']) && !in_array($b2bData['phone'], $existingPhonesB2B)) {
                        $b2bData['pays_id'] = $this->pays_id;
                        $b2bData['created_at'] = now();
                        $b2bData['updated_at'] = now();
                        $newB2BData[] = $b2bData;
                        $existingPhonesB2B[] = $b2bData['phone'];

                        if (count($newB2BData) >= $batchSize) {
                            DB::table('b2b')->insert($newB2BData);
                            $newB2BData = [];
                        }
                    } else {
                        $skippedCount++;
                    }
                }

                // Même logique pour B2C
                if (!empty($this->b2cMapping)) {
                    $b2cData = $this->mapRowData($row, $this->b2cMapping);
                    
                    if (!empty($b2cData['phone']) && !in_array($b2cData['phone'], $existingPhonesB2C)) {
                        $b2cData['pays_id'] = $this->pays_id;
                        $b2cData['created_at'] = now();
                        $b2cData['updated_at'] = now();
                        $newB2CData[] = $b2cData;
                        $existingPhonesB2C[] = $b2cData['phone'];

                        if (count($newB2CData) >= $batchSize) {
                            DB::table('b2c')->insert($newB2CData);
                            $newB2CData = [];
                        }
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

            // Créer l'historique
            ImportHistory::create([
                'pays_id' => $this->pays_id,
                'user_id' => $this->userId,
                'filename' => $this->filename,
                'total_records' => count($this->data),
                'imported_records' => count($newB2BData) + count($newB2CData),
                'skipped_records' => $skippedCount,
                'status' => 'completed'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            // Créer une entrée d'historique avec status error
            // ImportHistory::create([
            //     'pays_id' => $this->pays_id,
            //     'user_id' => $this->userId,
            //     'filename' => $this->filename,
            //     'status' => 'failed',
            //     'error_message' => $e->getMessage()
            // ]);
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
}