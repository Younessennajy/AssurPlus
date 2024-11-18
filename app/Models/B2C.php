<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class B2C extends Model
{
    use HasFactory;

    protected $table = 'b2c'; 

    protected $fillable = [
        'first_name', 
        'last_name',   
        'address',     
        'postal_code', 
        'ville',       
        'phone',       
        'gsm',         
        'pays_id',     
    ];

 
    public function pays()
    {
        return $this->belongsTo(Pays::class, 'pays_id'); 
    }
}
