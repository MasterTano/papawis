<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_games', function (Blueprint $table) {
            $table->bigIncrements('user_game_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('booking_id');
            $table->string('status', 50);
            $table->timestamps();

            $table->foreign('user_id', 'user_games_user_id')
                ->references('user_id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('booking_id', 'user_games_court_booking_id')
                ->references('booking_id')->on('user_court_bookings');
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
        Schema::dropIfExists('user_games');
    }
}
