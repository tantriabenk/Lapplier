<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductSelling extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selling', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('selling_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->float('price_sell')->nullable();
            $table->integer('qty');
            $table->float('total', 10, 2);
            $table->float('discount', 10, 2)->nullable();
            $table->timestamps();

            $table->foreign('selling_id')->references('id')->on('sellings');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_selling', function(Blueprint $table){
            $table->dropForeign(['selling_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('product_selling');
    }
}
