<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jockey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jockey', function(Blueprint $table){
            $table->id();
            $table->string('user_id');
            $table->string('name');
            $table->string('age');
            $table->string('gender');
            $table->string('prize');
            $table->string('happy');
            $table->string('tired');
            $table->string('level');
            $table->string('t1');
            $table->string('t2');
            $table->string('t3');
            $table->string('t4');
            $table->string('p_miss');
            $table->string('p_target');
            $table->string('p_difference');
            $table->string('p_add');
            $table->string('direction');
            $table->string('special')->nullable();
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
