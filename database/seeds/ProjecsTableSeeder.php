<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder {

  public function run()
  {

    DB::table('teachers')->delete();
    $teachers = array(
      ['id' => 1, 'name' => 'Kevint', 'surname' => 'Pineaps',
	'email' => "pineaps@gmail.com", 'password' => Hash::make('two'), 'admin' => true],
	['id' => 2, 'name' => 'Banant', 'surname' => 'Nanat',
	  'email' => "nanant@gmail.com", 'password' => Hash::make('two'), 'admin' => false],
	['id' => 3, 'name' => 'Persi', 'surname' => 'Going Ont',
	  'email' => "persi@gmail.com", 'password' => Hash::make('two'), 'admin' => false]
    );
    DB::table('teachers')->insert($teachers);

    DB::table('schoolclasses')->delete();
    $schoolclasses = array(
      ['id' => 1, 'name' => 'Sculpture', 'hour_count' => 30],
	['id' => 2, 'name' => 'Painting', 'hour_count' => 14],
	['id' => 3, 'name' => 'Drawing', 'hour_count' => 10]
    );
    DB::table('schoolclasses')->insert($schoolclasses);

    DB::table('classrooms')->delete();
    $classrooms = array(
      ['id' => 1, 'name' => '32'],
	['id' => 2, 'name' => '34b'],
	['id' => 3, 'name' => '16']
    );
    DB::table('classrooms')->insert($classrooms);

    DB::table('plans')->delete();
    $plans = array(
      ['id' => 1, 'name' => 'test_plan']
    );
    DB::table('plans')->insert($plans);

    DB::table('plan_entries')->delete();
    $plan_entries = array(
      ['plan_id' => 1, 'teacher_id' => 1, 'schoolclass_id' => 1, 'classroom_id' => 1, 'week_day' => 0, 'time_start' => '12:00:00', 'time_end' => '14:00:00']
    );
    DB::table('plan_entries')->insert($plan_entries);

    DB::table('students')->delete();
    $students = array(
      ['id' => 1, 'name' => 'Kevin', 'surname' => 'Durant', 'plan_id' => 1,
	'email' => "durant@gmail.com", 'password' => Hash::make('one')],
	['id' => 2, 'name' => 'Banan', 'surname' => 'Nana', 'plan_id' => 1,
	  'email' => "nan@gmail.com", 'password' => Hash::make('one')],
	['id' => 3, 'name' => 'Whats', 'surname' => 'GoingOn', 'plan_id' => 1,
	  'email' => "goingon@gmail.com", 'password' => Hash::make('one')]
    );
    DB::table('students')->insert($students);

  }
}
