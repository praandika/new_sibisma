<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProspectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prospects', function (Blueprint $table) {
            $table->id();
            $table->string('prospect_key')->unique();

            $table->string('dealer_code', 10)->nullable();

            // Header
            $table->string('point_code', 20)->nullable();
            $table->string('customer_name')->nullable();
            $table->string('ktp_no', 30)->nullable();
            $table->date('prospect_date')->nullable();
            $table->string('prospect_type', 50)->nullable();
            $table->string('company_name')->nullable();
            $table->string('interest_type', 100)->nullable();
            $table->string('interest_color', 100)->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('occupation', 100)->nullable();
            $table->string('payment_type', 50)->nullable();
            $table->integer('deposit')->nullable();
            $table->integer('discount')->nullable();
            $table->string('leasing_name', 50)->nullable();
            $table->integer('down_payment')->nullable();
            $table->integer('tenor')->nullable();
            $table->integer('price')->nullable();

            // Address
            $table->string('city', 100)->nullable();
            $table->string('district', 100)->nullable();
            $table->string('subdistrict', 100)->nullable();
            $table->text('address')->nullable();

            // Contact
            $table->string('phone', 30)->nullable();
            $table->string('salesman', 100)->nullable();

            // Shipment
            $table->text('shipment_address')->nullable();

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
        Schema::dropIfExists('prospects');
    }
}