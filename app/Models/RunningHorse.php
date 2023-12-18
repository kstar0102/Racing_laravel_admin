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
}
