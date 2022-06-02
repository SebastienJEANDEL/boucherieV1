<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espece extends Model
{
    /**
     * Get all related races
     */
    public function races()
    {
        return $this->hasMany(Race::class);
    }
}
