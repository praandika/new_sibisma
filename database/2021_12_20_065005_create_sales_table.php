<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date('sale_date');
            $table->unsignedInteger('stock_id');
            $table->bigInteger('nik')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->integer('sale_qty');
            $table->string('frame_no')->nullable();
            $table->string('engine_no')->nullable();
            $table->enum('status',['pending','delivered']);
            $table->unsignedInteger('leasing_id');
            $table->string('spk')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
