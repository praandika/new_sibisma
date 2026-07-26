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

            // Data Prospect
            $table->string('prospect_key');
            $table->string('dealer_code', 10);
            $table->string('point_code', 20);
            $table->string('customer_name');
            $table->string('ktp_no', 30);
            $table->date('prospect_date');
            $table->string('company_name')->nullable();
            $table->string('model_name', 100);
            $table->string('model_color', 100);
            $table->string('payment_type', 50);
            $table->integer('deposit')->nullable();
            $table->integer('discount')->nullable();
            $table->string('leasing_name', 50)->nullable();
            $table->integer('down_payment')->nullable();
            $table->integer('tenor')->nullable();
            $table->integer('price')->nullable();
            $table->text('address');
            $table->string('phone', 30);
            $table->string('salesman', 100);
            $table->text('shipment_address');

            // Additional Input
            $table->string('spk_no');
            $table->date('spk_date');
            $table->string('kk_no', 30);
            $table->string('description')->nullable();
            $table->text('ktp_file');
            $table->string('bunga')->nullable();
            $table->string('pemohon_name')->nullable();
            $table->enum('credit_status',['survey','acc','reject','cancel','cash']);
            $table->enum('spk_status',['indent','ready']);
            $table->enum('sale_status',['pending','sold']);

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
