<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceManagement extends Model
{
    use HasFactory;

    public function places(){
        return $this->belongsTo(places::class, 'event_place');
    }

    public function running_horses(){
        return $this->hasMany(RunningHorse::class);
    }

    public function web_race_results(){
        return $this->hasMany(WebRaceResult::class, 'race_management_id');
    }

    public function delete_horses(){
        return $this->hasMany(DeleteHorse::class);
    }
}
