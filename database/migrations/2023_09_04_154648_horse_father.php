<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class HorseFather extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create("hrose_father", function(Blueprint $table){
            $table->id();
            $table->string('name')->comment('馬名');
            $table->string('price')->comment('金額(Pt)');
            $table->string('color')->comment('毛色');
            $table->string('growth')->comment('成長');
            $table->string('ground')->comment('馬場');
            $table->string('quality_leg')->comment('脚質');
            $table->string('speed')->comment('ＳＰ');
            $table->string('strength')->comment('ＳＴ');
            $table->string('stamina')->comment('根性');
            $table->string('moment')->comment('瞬発');
            $table->string('condition')->comment('気性');
            $table->string('health')->comment('体質');
            $table->string('distance_min')->comment('距離(下限)');
            $table->string('distance_max')->comment('距離(上限)');
            $table->boolean('hidden')->comment('隠し');
            $table->boolean('triple_crown')->comment('三冠');
            // start 
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
            //3
            $table->string('f_f_f_sys')->comment('3系統');
            $table->string('f_f_f_name')->comment('父父父');
            $table->string('f_f_f_factor')->comment('因子');
            $table->string('f_f_m_sys')->comment('3系統');
            $table->string('f_f_m_name')->comment('父父母');

            $table->string('f_m_f_sys')->comment('3系統');
            $table->string('f_m_f_name')->comment('父母父');
            $table->string('f_m_f_factor')->comment('因子');
            $table->string('f_m_m_sys')->comment('2系統');
            $table->string('f_m_m_name')->comment('父母母');

            $table->string('m_f_f_sys')->comment('3系統');
            $table->string('m_f_f_name')->comment('母父父');
            $table->string('m_f_f_factor')->comment('因子');
            $table->string('m_f_m_sys')->comment('3系統');
            $table->string('m_f_m_name')->comment('母父母');

            $table->string('m_m_f_sys')->comment('3系統');
            $table->string('m_m_f_name')->comment('母母父');
            $table->string('m_m_f_factor')->comment('因子');
            $table->string('m_m_m_sys')->comment('2系統');
            $table->string('m_m_m_name')->comment('母母母');
            //4
            // $table->string('f_f_f_f_sys')->comment('4系統');
            // $table->string('f_f_f_f_name')->comment('父父父父');
            // $table->string('f_f_f_f_factor')->comment('因子');

            // $table->string('f_f_m_f_sys')->comment('4系統');
            // $table->string('f_f_m_f_name')->comment('父父母父');
            // $table->string('f_f_m_f_factor')->comment('因子');

            // $table->string('f_m_f_f_sys')->comment('4系統');
            // $table->string('f_m_f_f_name')->comment('父父母父');
            // $table->string('f_m_f_f_factor')->comment('因子');

            // $table->string('f_m_m_f_sys')->comment('4系統');
            // $table->string('f_m_m_f_name')->comment('父母母父');
            // $table->string('f_m_m_f_factor')->comment('因子');

            // $table->string('m_f_f_f_sys')->comment('4系統');
            // $table->string('m_f_f_f_name')->comment('母父父父');
            // $table->string('m_f_f_f_factor')->comment('因子');

            // $table->string('m_f_m_f_sys')->comment('4系統');
            // $table->string('m_f_m_f_name')->comment('母父母父');
            // $table->string('m_f_m_f_factor')->comment('因子');

            // $table->string('m_m_f_f_sys')->comment('4系統');
            // $table->string('m_m_f_f_name')->comment('母母父父');
            // $table->string('m_m_f_f_factor')->comment('因子');

            // $table->string('m_m_m_f_sys')->comment('4系統');
            // $table->string('m_m_m_f_name')->comment('母母母父');
            // $table->string('m_m_m_f_factor')->comment('因子');

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
