<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Race extends Model
{
    /**
     * Get the related Animals
     */
    public function animals()
    {
        return $this->belongsTo(Animal::class);
    }

    /**
     * Get the related Platform
     */
    public function espece()
    {
        return $this->belongsTo(Espece::class);
    }
}
