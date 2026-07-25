<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branch_deliveries', function (Blueprint $table) {
            $table->id();
            $table->date('branch_delivery_date');
            $table->unsignedInteger('out_id');
            $table->time('delivery_time');
            $table->time('arrival_time')->nullable();
            $table->unsignedInteger('main_driver');
            $table->unsignedInteger('backup_driver');
            $table->enum('status',['prepared','on the way','has arrived']);
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
        Schema::dropIfExists('branch_deliveries');
    }
}
