<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTradeActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trade_actions', function (Blueprint $table) {

            $table->increments('id');

            $table->boolean('bc')->default(0);
            $table->integer('bc_member_id')->unsigned()->nullable();
            $table->foreign('bc_member_id')->references('id')->on('members');
            $table->string('bc_time')->nullable();

            $table->boolean('dv')->default(0);
            $table->integer('dv_member_id')->unsigned()->nullable();
            $table->foreign('dv_member_id')->references('id')->on('members');
            $table->string('dv_time')->nullable();

            $table->boolean('done')->default(0);
            $table->integer('done_member_id')->unsigned()->nullable();
            $table->foreign('done_member_id')->references('id')->on('members');
            $table->string('done_time')->nullable();

            $table->boolean('delivery')->default(0);
            $table->integer('delivery_member_id')->unsigned()->nullable();
            $table->foreign('delivery_member_id')->references('id')->on('members');
            $table->string('delivery_time')->nullable();

            $table->boolean('store')->default(0);
            $table->integer('store_member_id')->unsigned()->nullable();
            $table->foreign('store_member_id')->references('id')->on('members');
            $table->string('store_time')->nullable();

            $table->string('bl')->nullable();
            $table->integer('bl_member_id')->unsigned()->nullable();
            $table->foreign('bl_member_id')->references('id')->on('members');
            $table->string('bl_time')->nullable();

            $table->string('fc')->nullable();
            $table->integer('fc_member_id')->unsigned()->nullable();
            $table->foreign('fc_member_id')->references('id')->on('members');
            $table->string('fc_time')->nullable();

            $table->json('tasks');
            $table->string('status')->default('int');

            $table->integer('company_id')->index()->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')
                ->onDelete('cascade');

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
        Schema::dropIfExists('trade_actions');
    }
}
