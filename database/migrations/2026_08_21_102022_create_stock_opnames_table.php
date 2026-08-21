<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockOpnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();
            $table->string('opname_no', 50)->unique();

            $table->string('dealer_code', 20);

            $table->date('opname_date');

            $table->string('status', 20)->default('DRAFT');

            $table->unsignedBigInteger('created_by')->nullable();

            $table->unsignedBigInteger('submitted_by')->nullable();

            $table->dateTime('submitted_at')->nullable();

            $table->unsignedBigInteger('approved_by')->nullable();

            $table->dateTime('approved_at')->nullable();

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->index('dealer_code');
            $table->index('opname_date');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_opnames');
    }
}
