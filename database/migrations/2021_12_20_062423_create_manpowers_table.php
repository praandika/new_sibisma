<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManpowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manpowers', function (Blueprint $table) {
            $table->id();
            $table->enum('status',['active','mutation','resign']);
            $table->unsignedInteger('dealer_id');
            $table->string('name');
            $table->text('address');
            $table->string('phone');
            $table->string('name_dpack')->nullable();
            $table->date('birthday');
            $table->enum('gender',['L','P']);
            $table->date('join_date');
            $table->date('resign_date')->nullable();
            $table->string('position');
            $table->string('years_of_service')->nullable();
            $table->string('education')->nullable();
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
        Schema::dropIfExists('manpowers');
    }
}
