<?php

use Illuminate\Database\Seeder;
//Include Question and Answer 
//Models so we can use them
use App\Question;
use App\Answer;
use App\Course;
use App\User;
use App\Quiz;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//Optional just to clear table
        // DB::table('questions')->delete();
		// DB::table('answers')->delete();
    	$user = User::create([
            'name' => 'Dr. Andre Chen',
            'email' => str_random(10).'@gmail.com',
            'password' => bcrypt('secret'),
            'type' => 'lecturer'
        ]);
    	$this->command->info('User Created!');

    	$course = Course::create([
    		'name' => 'Math',
    		'term' => 'Fall2020',
    		'lecturer_id' => '5',
    		]);
    	$this->command->info('Course Created!');

    	$quiz = Quiz::create([
    		'class_id' => $course->id,
    		'description' => 'A Quiz to test your might',
    		'quizTime' => '20',
    		'startDate' => '10.29.2015',
    		'endDate' => '10.30.2015'
    		]);

    	$this->command->info('Quiz Created!');
    	// Syncing Quiz to Questions
		// $course->quizzes()->attach($quiz->id);


    	$this->command->info('Corse-Quiz Linked!');
    	//Questions
		$q = Question::create([
			'prompt' => 'What is the sqare root of 4?',
			'difficulty' => 'easy',
			]);
    	$this->command->info('Question 1 Created!');
		$q1 = Question::create([
					'prompt' => 'What is 2 X 3?',
					'difficulty' => 'easy',
					]);

    	$this->command->info('Question 2 Created!');
		//Answers
		$a = Answer::create([
			'text' => '6',
			'image' => NULL,
			]);
		$a1 = Answer::create([
			'text' => '2',
			'image' => NULL,
			]);
		$a1 = Answer::create([
			'text' => '6',
			'image' => NULL,
			]);
		$a11 = Answer::create([
			'text' => '5',
			'image' => NULL,
			]);

    	$this->command->info('All 4 Answers Created!');

		// Syncing Quiz to Questions
		$quiz->questions()->sync([$q->id, $q1->id]);

		// Syncing (Binding Qustion to Answer)
		$q->answers()->sync([$a->id, $a1->id]);
		$q1->answers()->sync([$a1->id, $a11->id]);

    	$this->command->info('Everything Created and Linked!');
    }
}
