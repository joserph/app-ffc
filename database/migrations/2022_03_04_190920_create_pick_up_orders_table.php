<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePickUpOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pick_up_orders', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->date('loading_date');
            $table->time('loading_hour');
            $table->string('carrier_company');
            $table->string('driver_name');
            $table->integer('carrier_num');
            $table->string('pick_up_location');
            $table->string('pick_up_address');
            $table->string('consigned_to');
            $table->string('drop_off_address');

            $table->foreignId('id_user')->references('id')->on('users');
            $table->foreignId('update_user')->references('id')->on('users');

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
        Schema::dropIfExists('pick_up_orders');
    }
}
