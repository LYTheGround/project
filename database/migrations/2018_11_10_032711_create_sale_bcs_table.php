<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleBcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_bcs', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('qt')->unsigned();

            $table->integer('sale_id')->unsigned()->index();
            $table->foreign('sale_id')->references('id')->on('sales');

            $table->integer('purchased_id')->unsigned()->index();
            $table->foreign('purchased_id')->references('id')->on('purchaseds');

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
        Schema::dropIfExists('sale_bcs');
    }
}
