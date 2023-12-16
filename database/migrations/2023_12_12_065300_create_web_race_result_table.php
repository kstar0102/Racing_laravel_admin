<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebRaceResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('web_race_result', function (Blueprint $table) {
            $table->id();
            $table->string('rank');
            $table->foreignId('horse')->constrained('running_horse')->onDelete('cascade');
            $table->string('odds')->nullable();
            $table->string('single');
            $table->string('double');
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
        Schema::dropIfExists('web_race_result');
    }
}
