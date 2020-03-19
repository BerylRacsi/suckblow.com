<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('agency');
            $table->string('diver');
            $table->boolean('open')->default(false);
            $table->boolean('advance')->default(false);
            $table->boolean('rescue')->default(false);
            $table->boolean('master')->default(false);
            $table->boolean('instructor')->default(false);
            $table->string('center');
            $table->smallInteger('total');
            $table->year('since');
            $table->string('ig');
            $table->string('fb');
            $table->string('image');
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
        Schema::dropIfExists('courses');
    }
}
