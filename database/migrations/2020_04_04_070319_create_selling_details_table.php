<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('selling_id')->unsigned()->nullable();
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->float('price_sell');
            $table->integer('qty');
            $table->float('total');
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
        Schema::table('selling_details', function(Blueprint $table){
            $table->dropForeign(['selling_id']);
            $table->dropForeign(['product_id']);
        });

        Schema::dropIfExists('selling_details');
    }
}
