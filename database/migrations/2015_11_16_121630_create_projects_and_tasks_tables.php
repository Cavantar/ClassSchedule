<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsAndTasksTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('students', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->default('');
      $table->string('surname')->default('');

      $table->string('email')->unique();
      $table->string('password', 60);
    });

    Schema::create('teachers', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->default('');
      $table->string('surname')->default('');

      $table->string('email')->unique();
      $table->string('password', 60);
      $table->boolean('admin')->default(false);
    });

    Schema::create('schoolclasses', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->default('');
      $table->integer('hour_count')->unsigned()->default(0);
    });

    Schema::create('classrooms', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->default('');
    });

    Schema::create('plans', function (Blueprint $table) {
      $table->increments('id');
      $table->string('name')->default('');
    });

    Schema::create('plan_entries', function (Blueprint $table) {
      $table->increments('id');

      $table->integer('plan_id')->unsigned()->default(0);
      $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');

      $table->integer('teacher_id')->unsigned()->default(0);
      $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('cascade');

      $table->integer('schoolclass_id')->unsigned()->default(0);
      $table->foreign('schoolclass_id')->references('id')->on('schoolclasses')->onDelete('cascade');

      $table->integer('classroom_id')->unsigned()->default(0);
      $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');

      $table->integer('week_day')->unsigned()->default(0);
      $table->time('time_start');
      $table->time('time_end');
    });

    Schema::table('students', function ($table) {
      $table->integer('plan_id')->unsigned()->default(0);
      $table->foreign('plan_id')->references('id')->on('plans')->onDelete('cascade');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    /* */
    Schema::drop('plan_entries');
    Schema::drop('students');
    Schema::drop('plans');
    Schema::drop('classrooms');
    Schema::drop('schoolclasses');
    Schema::drop('teachers');

  }
}
