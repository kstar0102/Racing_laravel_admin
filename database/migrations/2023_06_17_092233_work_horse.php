<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('work_horse', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('distance_max');
            $table->string('distance_min');
            $table->string('color');
            $table->string('gender');
            $table->string('growth');
            $table->string('ground');
            $table->string('quality_leg');
            $table->string('speed');
            $table->string('strength');
            $table->string('moment');
            $table->string('stamina');
            $table->string('condition');
            $table->string('health');
            $table->string('price');
            $table->boolean('hidden')->comment('隠し');
            $table->boolean('triple_crown')->comment('三冠');
            //parents
            //1
            $table->string('f_sys')->comment('1系統');
            $table->string('f_name')->comment('①父');
            $table->string('f_factor')->comment('因子');
            $table->string('m_sys')->comment('1系統');
            $table->string('m_name')->comment('母');
            //2
            $table->string('f_f_sys')->comment('2系統');
            $table->string('f_f_name')->comment('②父父');
            $table->string('f_f_factor')->comment('因子');
            $table->string('f_m_sys')->comment('2系統');
            $table->string('f_m_name')->comment('父母');

            $table->string('m_f_sys')->comment('2系統');
            $table->string('m_f_name')->comment('②母父');
            $table->string('m_f_factor')->comment('因子');
            $table->string('m_m_sys')->comment('2系統');
            $table->string('m_m_name')->comment('母母');

            $table->string('user_id');
            $table->string('pasture_id');
            $table->string('etc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
