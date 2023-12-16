<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RunningHorse extends Model
{
    use HasFactory;

    protected $table = "running_horse";

    public function delete_horses(){
        return $this->belongsTo(DeleteHorse::class, 'name');
    }
}
