<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpkEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spk_entries', function (Blueprint $table) {
            $table->id();
            // SPK
            $table->string('spk_no');
            $table->date('spk_date');
            $table->string('dealer_code', 10);

            // Prospect
            $table->string('prospect_key');
            $table->string('customer_name');
            $table->string('ktp_no', 30);
            $table->date('prospect_date');
            $table->string('model_name');
            $table->string('model_color', 100);
            $table->integer('price');
            $table->string('phone', 30);
            $table->string('salesman', 100);
            $table->string('payment_type', 50);
            $table->integer('deposit')->nullable();
            $table->integer('discount')->nullable();
            $table->string('leasing_name', 50)->nullable();
            $table->integer('down_payment')->nullable();
            $table->integer('tenor')->nullable();
            $table->integer('price');
            $table->text('address');
            $table->text('shipment_address');

            // Additional Input
            $table->text('ktp_file');
            $table->text('description')->nullable();
            $table->enum('credit_status',['survey','acc','reject','cancel','cash']);
            $table->enum('spk_status',['indent','ready']);
            $table->string('stnk_name');
            $table->string('pemohon_name')->nullable();
            $table->string('kk_no')->nullable();
            $table->enum('sale_status',['pending','sold']);
            $table->string('frame_no');
            $table->string('engine_no');
            $table->string('bunga', 10)->nullable();
            $table->string('year_mc');



            $table->string('spk_phone');
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
        Schema::dropIfExists('spk_entries');
    }
}
