<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebRaceResult extends Model
{
    use HasFactory;

    protected $table = "web_race_result";

    public function race_managements(){
        return $this->belongsTo(RaceManagement::class, 'race_management_id');
    }
}
