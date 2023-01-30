<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spks', function (Blueprint $table) {
            $table->id();
            $table->string('spk_no');
            $table->date('spk_date');
            $table->string('order_name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('stnk_name');
            $table->unsignedInteger('stock_id');
            $table->integer('downpayment');
            $table->integer('discount');
            $table->integer('payment');
            $table->unsignedInteger('leasing_id');
            $table->unsignedInteger('manpower_id');
            $table->text('description');
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
        Schema::dropIfExists('spks');
    }
}
