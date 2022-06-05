<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reserves', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('user_id');
            $table->integer('transfer_id');
            $table->string('from_location_id',100);
            $table->string('to_location_id',100);
            $table->float('price');
            $table->date('flightDate');
            $table->time('flightTime');
            $table->time('pickupTime');
            $table->string('note',100)->nullable();
            $table->string('IP',20);
            $table->string('status',30)->default('New');
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
        Schema::dropIfExists('reserves');
    }
};
