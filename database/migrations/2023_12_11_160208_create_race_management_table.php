<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRaceManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_management', function (Blueprint $table) {
            $table->id();
            $table->string('event_date');
            $table->foreignId('event_place')->constrained('places')->onDelete('cascade');
            $table->string('race_number');
            $table->string('hour_data');
            $table->string('minute_data');
            $table->string('race_name');
            $table->string('month_data');
            $table->integer('race_state')->default(0);
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
        Schema::dropIfExists('race_management');
    }
}
