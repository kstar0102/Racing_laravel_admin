<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerRankingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('player_ranking', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('double_circle');
            $table->boolean('single_circle');
            $table->boolean('triangle');
            $table->boolean('five_star');
            $table->boolean('hole');
            $table->boolean('disappear');
            $table->double('user_pt');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('race_management_id')->constrained('race_management')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('player_ranking');
    }
}
