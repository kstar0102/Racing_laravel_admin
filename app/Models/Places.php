<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    use HasFactory;

    public function race_managements(){
        return $this->hasOne(RaceManagement::class, 'event_place');
    }
}
