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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('sku');
            $table->double('price',10,2);  
            $table->boolean('p_enble');  
            $table->double('opening_stock',10,2);  
            $table->double('total_sales',10,2);  
            $table->double('total_purchase',10,2);  
            $table->double('closing_stock',10,2);  
            $table->string('stock_unit');  
            $table->string('photos');  
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
        Schema::dropIfExists('products');
    }
};
