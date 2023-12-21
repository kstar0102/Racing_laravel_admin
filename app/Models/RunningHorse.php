<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningHorse extends Model
{
    use HasFactory;

    protected $table = "running_horse";

    protected $fillable = [ 'name', 'race_management_id' ];

    public function delete_horses(){
        return $this->belongsTo(DeleteHorse::class, 'name');
    }

    public function double_circles(){
        return $this->hasOne(ExpectedBattle::class, 'double_circle');
    }

    public function single_circles(){
        return $this->hasOne(ExpectedBattle::class, 'single_circle');
    }

    public function triangles(){
        return $this->hasOne(ExpectedBattle::class, 'triangle');
    }

    public function five_stars(){
        return $this->hasOne(ExpectedBattle::class, 'five_star');
    }

    public function holes(){
        return $this->hasOne(ExpectedBattle::class, 'hole');
    }

    public function disappears(){
        return $this->hasOne(ExpectedBattle::class, 'disappear');
    }
}
