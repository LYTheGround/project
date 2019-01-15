<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_orders', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('pu');
            $table->decimal('ht');
            $table->decimal('tva');
            $table->decimal('ttc');
            $table->decimal('tva_payed');
            $table->decimal('profit');
            $table->decimal('taxes');
            $table->decimal('profit_after_taxes');

            $table->integer('sale_dv_id')->unsigned()->index();
            $table->foreign('sale_dv_id')->references('id')->on('sale_dvs');

            $table->integer('sale_bc_id')->unsigned()->index();
            $table->foreign('sale_bc_id')->references('id')->on('sale_bcs');

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
        Schema::dropIfExists('sale_orders');
    }
}
