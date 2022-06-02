<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    /**
     * Get the related Piece
     */
    public function pieces()
    {
        return $this->hasMany(Piece::class);
    }

    /**
     * Get the related Race
     */
    public function race()
    {
        return $this->hasOne(Race::class);
    }
     /**
     * Get the related Producer
     */
    public function producer()
    {
        return $this->hasOne(Producer::class);
    }
}
