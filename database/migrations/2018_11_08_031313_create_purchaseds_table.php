<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchaseds', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('qt')->unsigned();
            $table->integer('store_qt')->unsigned();
            $table->integer('offer_qt')->unsigned();

            $table->integer('product_id')->unsigned()->index();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('month_id')->unsigned()->index()->nullable();
            $table->foreign('month_id')->references('id')->on('months');

            $table->integer('accounting_id')->unsigned()->index()->nullable();
            $table->foreign('accounting_id')->references('id')->on('accountings');

            $table->integer('buy_order_id')->unsigned()->index()->nullable();
            $table->foreign('buy_order_id')->references('id')->on('buys');

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
        Schema::dropIfExists('purchaseds');
    }
}
