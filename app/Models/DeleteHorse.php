<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeleteHorse extends Model
{
    use HasFactory;

    protected $table = "delete_horse";

    public function running_horses(){
        return $this->hasOne(RunningHorse::class, 'name');
    }
}
