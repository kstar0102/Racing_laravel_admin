<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horse extends Model
{
    use HasFactory;

    protected $table = "work_horse";

    public function sale_horses(){
        return $this->hasOne(SaleHorse::class, 'horse_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
}