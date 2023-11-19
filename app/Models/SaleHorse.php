<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Carbon\Carbon;

class SaleHorse extends Model
{
    use HasFactory;

    protected $table = "sale_horse";

    protected $dates = ['created_at'];

    // protected static function boot(){

    //     parent::boot();

    //     static::deleting(function($saleHorse){

    //         $saleHorse->work_horses()->delete();

    //     });
    // }

    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         $model->created_at = Carbon::now()->subDay();
    //     });
    // }

    public function work_horses(){
        return $this->belongsTo(Horse::class, 'horse_id');
    }

    public function highest_bidders(){
        return $this->belongsTo(User::class, 'highest_bidder');
    }

}
