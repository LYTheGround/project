<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable()->unique();

            $table->decimal('ht');
            $table->decimal('tva');
            $table->decimal('ttc');
            $table->decimal('tva_payed');
            $table->decimal('profit');
            $table->decimal('taxes');
            $table->decimal('profit_after_taxes');

            $table->integer('company_id')->unsigned()->index();
            $table->foreign('company_id')->references('id')->on('companies');

            $table->integer('month_id')->unsigned()->index()->nullable();
            $table->foreign('month_id')->references('id')->on('months');

            $table->integer('trade_action_id')->unsigned()->index();
            $table->foreign('trade_action_id')->references('id')->on('trade_actions');

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
        Schema::dropIfExists('sales');
    }
}
