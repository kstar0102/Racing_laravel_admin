<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HorseGrow extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grow_horse', function(Blueprint $table){
            $table->id();
            $table->string('horse_id');
            $table->string('type');
            $table->string('speed_b');
            $table->string('strength_b');
            $table->string('moment_b');
            $table->string('stamina_b');
            $table->string('condition_b');
            $table->string('health_b');
            $table->string('etc');
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
