<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RaceResult extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_result', function(Blueprint $table){
            $table->id();
            $table->string('race_id');
            $table->string('user_name');
            $table->string('user_id');
            $table->string('horse_name');
            $table->string('horse_id');
            $table->string('horse_gender');
            $table->string('horse_age');
            $table->string('mass');
            $table->string('jockey_name');
            $table->string('jockey_id');
            $table->string('quality_leg');
            $table->string('race_type');
            $table->string('stall_type');
            $table->string('prize');
            $table->string('time');
            $table->string('ranking');
            $table->string('last_play')->nullable();
            $table->string('etc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
