<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piece extends Model
{
    /**
     * Get all related animal
     */
    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
