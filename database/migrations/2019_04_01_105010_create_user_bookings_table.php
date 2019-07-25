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
            $table->unsignedBigInteger('user_id');
            $table->string('inclusion', 200);
            $table->dateTime('starts_at');
            $table->dateTime('ends_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('court_id', 'user_court_bookings_court_id')
                ->references('court_id')->on('courts')->onDelete('cascade');
            $table->foreign('user_id', 'user_court_bookings_user_id')
                ->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('user_court_bookings');
    }
}
