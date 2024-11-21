<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImportHistory extends Model
{
    protected $table = 'import_history';
    
    protected $fillable = [
        'user_id',
        'table_type',
        'pays_id',
        'filename',
        'records_imported',
        'tag',
        'is_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pays()
    {
        return $this->belongsTo(Pays::class);
    }
}