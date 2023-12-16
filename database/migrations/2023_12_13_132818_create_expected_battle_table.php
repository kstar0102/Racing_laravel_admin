<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpectedBattleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expected_battle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('double_circle')->constrained('running_horse')->onDelete('cascade');
            $table->foreignId('single_circle')->constrained('running_horse')->onDelete('cascade');
            $table->foreignId('triangle')->constrained('running_horse')->onDelete('cascade');
            $table->foreignId('five_star')->constrained('running_horse')->onDelete('cascade');
            $table->foreignId('hole')->constrained('running_horse')->onDelete('cascade');
            $table->foreignId('disappear')->constrained('running_horse')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('race_management_id')->constrained('race_management')->onDelete('cascade');
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
        Schema::dropIfExists('expected_battle');
    }
}
