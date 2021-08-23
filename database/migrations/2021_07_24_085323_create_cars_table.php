<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->timestamps();
            $table->primary('no_plate');
            $table->string('no_plate');
            $table->string('link');
            $table->text('car_name');
            $table->double('rate',3,2);
            $table->boolean('under_service')->default(false);
        });

        Schema::create('booking', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('no_plate');
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->time('start_time');
            $table->time('end_time');
            $table->text('pick_up');
            $table->text('note')->nullable();
            $table->integer('price');

            $table->foreign('no_plate')->references('no_plate')->on('cars')->onDelete('cascade');
            $table->foreign('name')->references('name')->on('users')->onDelete('cascade');


        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cars');
    }
}
