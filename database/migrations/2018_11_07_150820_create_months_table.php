<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('months', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('profit');
            $table->decimal('tva');
            $table->decimal('taxes');
            $table->decimal('tva_after_unload');
            $table->decimal('taxes_after_unload');

            $table->integer('accounting_id')->unsigned()->index();
            $table->foreign('accounting_id')->references('id')->on('accounting');

            $table->date('date');

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
        Schema::dropIfExists('months');
    }
}
