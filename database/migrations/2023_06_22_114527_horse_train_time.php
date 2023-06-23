<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HorseTrainTime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("horse_train_history", function(Blueprint $table){
            $table->id();
            $table->string('horse_id');
            $table->string('date_t');
            $table->string('time_t');
            $table->string('date_type');
            $table->string('what');
            $table->string('number_horse');
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
