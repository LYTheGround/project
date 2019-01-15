<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnloadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unloads', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');

            $table->string('justify');

            $table->decimal('prince');

            $table->boolean('taxes')->default(0);
            $table->boolean('tva')->default(0);
            $table->longText('description')->nullable();

            $table->integer('accounting_id')->unsigned()->index();
            $table->foreign('accounting_id')->references('id')->on('accountings');
            $table->integer('month_id')->unsigned()->index();
            $table->foreign('month_id')->references('id')->on('months');
            $table->integer('member_id')->unsigned()->index();
            $table->foreign('member_id')->references('id')->on('members');

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
        Schema::dropIfExists('unloads');
    }
}
