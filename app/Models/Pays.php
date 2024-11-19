<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pays extends Model
{
    use HasFactory;

    protected $table = 'pays'; // Nom de la table dans la base de données

    protected $fillable = [
        'name',       
        'indicatif', 
    ];

    /**
     * Relation avec le modèle B2C : Un pays peut avoir plusieurs entrées B2C.
     */
    public function b2cs()
    {
        return $this->hasMany(B2C::class, 'pays_id'); // Clé étrangère
    }

    /**
     * Relation avec le modèle B2B : Un pays peut avoir plusieurs entrées B2B.
     */
    public function b2bs()
    {
        return $this->hasMany(B2B::class, 'pays_id'); // Clé étrangère
    }
}
