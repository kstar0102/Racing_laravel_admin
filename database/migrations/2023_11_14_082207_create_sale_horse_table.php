<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleHorseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_horse', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('highest_bidder')->nullable()->constrained('users')->onDelete('cascade');
            $table->bigInteger('highest_bid_amount')->nullable();
            $table->double('remain_bidding_time', $precision = 0)->default(5);
            $table->foreignId('horse_id')->constrained('work_horse')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_horse');
    }
}
