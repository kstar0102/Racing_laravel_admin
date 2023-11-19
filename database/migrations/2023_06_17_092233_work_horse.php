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
        Schema::create('work_horse', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('age');
            $table->string('type');
            $table->string('class');
            $table->string('place');
            $table->string('distance_max');
            $table->string('distance_min');
            $table->string('color');
            $table->string('gender');
            $table->string('growth');
            $table->string('ground');
            $table->string('quality_leg');
            $table->string('speed_b');
            $table->string('strength_b');
            $table->string('moment_b');
            $table->string('stamina_b');
            $table->string('condition_b');
            $table->string('health_b');
            $table->string('speed_w');
            $table->string('strength_w');
            $table->string('moment_w');
            $table->string('stamina_w');
            $table->string('condition_w');
            $table->string('health_w');
            $table->string('happy');
            $table->string('tired');
            $table->string('price');
            $table->string('state');
            $table->string('direction');
            $table->boolean('hidden')->comment('隠し');
            $table->boolean('triple_crown')->comment('三冠');
    
            // Make changes to columns that caused the error
            $table->text('sys')->comment('系統');
            $table->text('f_sys')->comment('1系統');
            $table->text('f_name')->comment('①父');
            $table->text('f_factor')->comment('因子');
            $table->text('m_sys')->comment('1系統');
            $table->text('m_name')->comment('母');
            $table->text('f_f_sys')->comment('2系統');
            $table->text('f_f_name')->comment('②父父');
            $table->text('f_f_factor')->comment('因子');
            $table->text('f_m_sys')->comment('2系統');
            $table->text('f_m_name')->comment('父母');
            $table->text('m_f_sys')->comment('2系統');
            $table->text('m_f_name')->comment('②母父');
            $table->text('m_f_factor')->comment('因子');
            $table->text('m_m_sys')->comment('2系統');
            $table->text('m_m_name')->comment('母母');
            $table->text('f_f_f_sys')->comment('3系統');
            $table->text('f_f_f_name')->comment('父父父');
            $table->text('f_f_f_factor')->comment('因子');
            $table->text('f_f_m_sys')->comment('3系統');
            $table->text('f_f_m_name')->comment('父父母');
            $table->text('f_m_f_sys')->comment('3系統');
            $table->text('f_m_f_name')->comment('父母父');
            $table->text('f_m_f_factor')->comment('因子');
            $table->text('f_m_m_sys')->comment('2系統');
            $table->text('f_m_m_name')->comment('父母母');
            $table->text('m_f_f_sys')->comment('3系統');
            $table->text('m_f_f_name')->comment('母父父');
            $table->text('m_f_f_factor')->comment('因子');
            $table->text('m_f_m_sys')->comment('3系統');
            $table->text('m_f_m_name')->comment('母父母');
            $table->text('m_m_f_sys')->comment('3系統');
            $table->text('m_m_f_name')->comment('母母父');
            $table->text('m_m_f_factor')->comment('因子');
            $table->text('m_m_m_sys')->comment('2系統');
            $table->text('m_m_m_name')->comment('母母母');
    
            $table->string('user_id');
            $table->string('pasture_id');
            $table->string('stall_id');
            $table->string('etc')->nullable();
            $table->boolean('sale_state')->default(0);
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
