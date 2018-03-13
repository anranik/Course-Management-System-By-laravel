<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('courseId');
            $table->integer('instructorId');
            $table->date('year');
            $table->text('semester');
            $table->integer('totalSection');
            $table->enum('multiSection', ['course with multi section', 'separated courses for each section','i dont know'])->nullable();
            $table->text('otherInstructor')->nullable();
            $table->text('otherAssistance')->nullable();
            $table->text('remark')->nullable();
            $table->enum('requestType',['new','reactivate'])->default('new');
            $table->enum('status',['pending','activated','canceled'])->default('pending');
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
        Schema::dropIfExists('course_requests');
    }
}
