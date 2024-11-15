<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';

    protected $fillable = [
        'name',
        'country_code',
    ];

    public function b2c()
    {
        return $this->hasMany(B2C::class);
    }
}
