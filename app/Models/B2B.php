<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2B extends Model
{
    use HasFactory;

    protected $table = 'b2b';

    protected $fillable = [
        'raison_social',
        'dirigeant_name',
        'dirigeant_prenom',
        'address',
        'postal_code',
        'ville',
        'phone',
        'gsm',
        'pays_id'
    ];

    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id');
    }
}
