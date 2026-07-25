<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_deliveries', function (Blueprint $table) {
            $table->id();
            $table->date('sale_delivery_date');
            $table->unsignedInteger('sale_id');
            $table->string('down_payment')->nullable();
            $table->time('delivery_time')->nullable();
            $table->time('arrival_time')->nullable();
            $table->unsignedInteger('main_driver');
            $table->unsignedInteger('backup_driver');
            $table->enum('status',['prepared','on the way','has arrived','self pick up']);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('sale_deliveries');
    }
}
