<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('pd_id');
            $table->unsignedInteger('purchase_id');
            $table->unsignedInteger('pd_quantity');
            $table->unsignedInteger('pd_username');
            $table->unsignedInteger('pd_password');
            $table->unsignedInteger('pd_start_date');
            $table->unsignedInteger('pd_end_date');
            $table->unsignedInteger('pd_remarks');
            $table->unsignedInteger('pd_status');
            $table->unsignedInteger('pd_read');
            $table->foreign('purchase_id')->references('purchase_id')->on('purchases')->onDelete('cascade');
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
        Schema::dropIfExists('purchase_details');
    }
};
