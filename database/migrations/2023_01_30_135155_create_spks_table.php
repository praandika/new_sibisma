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
            $table->string('phone');
            $table->string('stnk_name');
            $table->unsignedInteger('stock_id');
            $table->integer('downpayment')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('payment')->nullable();
            $table->unsignedInteger('leasing_id');
            $table->unsignedInteger('manpower_id');
            $table->text('description')->nullable();
            $table->enum('payment_method',['cash','credit']);
            $table->enum('credit_status',['survey','acc','reject','cash']);
            $table->enum('order_status',['indent','available']);
            $table->enum('sale_status',['pending','sold']);
            $table->text('ktp')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
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
