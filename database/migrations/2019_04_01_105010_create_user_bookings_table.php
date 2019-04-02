<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_court_bookings', function (Blueprint $table) {
            $table->bigIncrements('booking_id');
            $table->unsignedBigInteger('court_id');
            $table->foreign('court_id', 'user_court_bookings_court_id')->references('court_id')->on('courts');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_court_bookings_user_id')->references('user_id')->on('users');
            $table->decimal('duration', 8, 1);
            $table->string('inclusion', 200);
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
        Schema::dropIfExists('user_bookings');
    }
}
