<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBuyDvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buy_dvs', function (Blueprint $table) {
            $table->increments('id');

            $table->string('slug')->nullable();
            $table->decimal('ht')->default(0);
            $table->decimal('tva')->default(0);
            $table->decimal('ttc')->default(0);
            $table->boolean('selected')->default(0);

            $table->integer('buy_id')->unsigned()->index();
            $table->foreign('buy_id')->references('id')->on('buys');

            $table->integer('provider_id')->unsigned()->index();
            $table->foreign('provider_id')->references('id')->on('providers');

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
        Schema::dropIfExists('buy_dvs');
    }
}
