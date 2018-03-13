<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workshops', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->enum('language', ['arabic', 'english']);
            $table->enum('oneDay', ['yes', 'no']);
            $table->date('dateFrom');
            $table->date('dateTo');
            $table->text('locationBuilding');
            $table->text('locationRoom');
            $table->enum('city', ['sakkair', 'isatown','other']);

            $table->integer('maxSeat');
            $table->enum('coffeBreak', ['yes', 'no']);
            $table->enum('invitationTo', ['no', 'activeInstructor','allInstructor']);
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
        Schema::dropIfExists('workshops');
    }
}
