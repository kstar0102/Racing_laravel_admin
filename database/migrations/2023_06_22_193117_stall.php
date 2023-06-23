<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Stall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('stalls', function(Blueprint $table){
            $table->id();
            $table->string('name')->unique();
            $table->string('host')->unique();
            $table->string('moto');
            $table->string('price');
            $table->string('possable');
            $table->string('volumn');
            $table->string('horses');
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
