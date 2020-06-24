<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpendingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spending_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('spending_id')->unsigned()->nullable();
            $table->string('description');
            $table->float('amount', 10, 2);
            $table->timestamps();

            $table->foreign('spending_id')->references('id')->on('spendings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spending_details');
    }
}
