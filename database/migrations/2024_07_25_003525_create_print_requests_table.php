<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_requests', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('request_by');
            $table->integer('approved_by')->nullable();
            $table->string('page', 100);
            $table->timestamp('is_approved')->nullable();
            $table->enum('is_printed', ['T', 'Y']);
            $table->timestamp('date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_requests');
    }
}
