<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Preset extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presets', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('preset_num');
            $table->string('pasture_id');
            $table->string('stall_id');
            $table->string('place');
            $table->string('food_name');
            $table->string('food_type');
            $table->string('user_id');
            $table->string('price');
            $table->integer('order');
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
