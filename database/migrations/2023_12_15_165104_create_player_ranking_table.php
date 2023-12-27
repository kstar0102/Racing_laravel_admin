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
            $table->Integer('double_circle')->default(0);
            $table->Integer('single_circle')->default(0);
            $table->Integer('triangle')->default(0);
            $table->Integer('five_star')->default(0);
            $table->Integer('hole')->default(0);
            $table->Integer('disappear')->default(0);
            $table->Integer('single_win')->default(0);
            $table->Integer('double_win_bonus')->default(0);
            $table->Integer('double_win')->default(0);
            $table->Integer('horse_racing_win')->default(0);
            $table->Integer('triple_racing_win')->default(0);
            $table->double('user_pt');
            $table->double('single_win_probability');
            $table->double('double_win_probability');
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
