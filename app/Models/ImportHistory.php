<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    protected $table = 'import_history';
    
    protected $fillable = [
        'table_type',
        'pays_id',
        'user_name',
        'tag',
        'action',
        'filename',
        'total_records',
        'imported_records',
        'skipped_records','unique_import_history'
    ];


    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}