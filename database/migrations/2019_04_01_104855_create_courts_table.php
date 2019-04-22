<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourtsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courts', function (Blueprint $table) {
            $table->bigIncrements('court_id');
            $table->unsignedBigInteger('address_id');
            $table->string('name', 100);
            $table->decimal('rate_per_hour', 8, 2);
            $table->decimal('peak_rate_per_hour', 8, 2);
            $table->decimal('minimum_rental_per_hour', 8, 1);
            $table->string('operating_hour', 100);
            $table->string('amenity', 250);
            $table->string('court_type', 100);
            $table->string('additional_info', 250);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('address_id', 'courts_address_id')
                ->references('address_id')
                ->on('addresses')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courts');
    }
}
