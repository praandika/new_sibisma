<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_locations', function (Blueprint $table) {
            $table->id();
            $table->string('dealer_code', 20);

            $table->string('location_code', 50);
            $table->string('location_name', 100);

            // Untuk lokasi bertingkat
            // contoh:
            // Gudang Utama
            //   └── Area A
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->string('status', 20)->default('ACTIVE');

            $table->unsignedBigInteger('created_by')->nullable();

            $table->timestamps();

            $table->index('dealer_code');
            $table->index('location_code');
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_locations');
    }
}
