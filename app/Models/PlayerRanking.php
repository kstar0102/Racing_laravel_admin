<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerRanking extends Model
{
    use HasFactory;

    protected $table = "player_ranking";

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function race_managements(){
        return $this->belongsTo(RaceManagement::class, 'race_management_id');
    }
}
