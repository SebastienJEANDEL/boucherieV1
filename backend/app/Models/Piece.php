<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    /**
     * Get all related animals
     */
    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
