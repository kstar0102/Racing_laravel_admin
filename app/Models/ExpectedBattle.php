<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpectedBattle extends Model
{
    use HasFactory;

    protected $table = "expected_battle";

    public function double_circles(){
        return $this->belongsTo(RunningHorse::class, 'double_circle');
    }

    public function single_circles(){
        return $this->belongsTo(RunningHorse::class, 'single_circle');
    }

    public function triangles(){
        return $this->belongsTo(RunningHorse::class, 'triangle');
    }

    public function five_stars(){
        return $this->belongsTo(RunningHorse::class, 'five_star');
    }

    public function holes(){
        return $this->belongsTo(RunningHorse::class, 'hole');
    }

    public function disappears(){
        return $this->belongsTo(RunningHorse::class, 'disappear');
    }
}