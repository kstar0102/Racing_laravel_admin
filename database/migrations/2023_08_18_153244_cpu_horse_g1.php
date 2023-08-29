<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CpuHorseG1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cpu_horse_g1', function (Blueprint $table) {
            $table->id();
            $table->string('name')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('jockey_name')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('gender')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('age')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('weight')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('color')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('need')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('quality_leg')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('speed');
            $table->string('strength');
            $table->string('stamina');
            $table->string('moment');
            $table->string('condition_b');
            $table->string('health');
            $table->string('distance_min')->comment('距離(下限)');
            $table->string('distance_max')->comment('距離(上限)');
            $table->string('happy');
            $table->string('tired');
            $table->string('baba')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string('ground')->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
            $table->string("game_name")->charset('utf8mb4')->collation('utf8mb4_unicode_ci');
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
