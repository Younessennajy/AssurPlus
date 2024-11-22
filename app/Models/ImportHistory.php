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
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}