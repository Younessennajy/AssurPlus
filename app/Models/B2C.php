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
        'city',
        'phone',
        'gsm',
        'country_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
