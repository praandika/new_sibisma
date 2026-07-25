<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_histories', function (Blueprint $table) {
            $table->id();
            $table->string('id_key')->unique();
            $table->date('history_date');
            $table->string('dealer_code');
            $table->integer('first_stock');
            $table->integer('in_qty');
            $table->integer('out_qty');
            $table->integer('sale_qty');
            $table->integer('faktur')->nullable();
            $table->integer('service')->nullable();
            $table->enum('opname',['no','yes'])->nullable();
            $table->integer('last_stock');
            $table->enum('status',['uncompleted','completed']);
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
        Schema::dropIfExists('stock_histories');
    }
}
