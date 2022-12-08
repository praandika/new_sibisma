<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('sale_id');
            $table->string('document_name');
            $table->string('stck')->nullable();
            $table->enum('stck_status', ['pending','on process','finished']);
            $table->string('stnk')->nullable();
            $table->enum('stnk_status', ['pending','on process','finished']);
            $table->string('bpkb')->nullable();
            $table->enum('bpkb_status', ['pending','on process','finished']);
            $table->text('document_note')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
