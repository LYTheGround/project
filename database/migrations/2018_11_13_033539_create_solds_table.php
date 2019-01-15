<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solds', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable();
            $table->integer('qt')->unsigned();

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('month_id')->unsigned()->index();
            $table->foreign('month_id')->references('id')->on('months');

            $table->integer('accounting_id')->unsigned()->index();
            $table->foreign('accounting_id')->references('id')->on('accountings');

            $table->integer('sale_order_id')->unsigned()->index();
            $table->foreign('sale_order_id')->references('id')->on('sale_orders');

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
        Schema::dropIfExists('solds');
    }
}
