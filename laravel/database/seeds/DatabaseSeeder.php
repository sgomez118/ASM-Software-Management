<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Question;
use App\Answer;
use App\Course;
use App\User;
use App\Quiz;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UserTableSeeder::class);
        // $this->call(ClassTableSeeder::class);
        //Optional just to clear table
        // DB::table('answers')->delete();
        // DB::table('questions')->delete();
        // DB::table('classes')->delete();
        // DB::table('users')->delete();
        $student1 = User::create([
            'name' => 'Scotty Gomez',
            'email' => str_random(2).'@gmail.com',
            'password' => bcrypt('secret'),
            'type' => 'student'
        ]);
        $student2 = User::create([
            'name' => 'Misha Dowd',
            'email' => str_random(2).'@gmail.com',
            'password' => bcrypt('secret'),
            'type' => 'student'
        ]);
        $lecturer = User::create([
            'name' => 'Dr. Andre Chen',
            'email' => str_random(2).'@gmail.com',
            'password' => bcrypt('secret'),
            'type' => 'lecturer'
        ]);
        $this->command->info('User Created!');

        $course = Course::create([
            'name' => 'Math',
            'term' => 'Fall2020',
            'lecturer_id' => $lecturer->id,
            ]);
        
        $this->command->info('Course Created!');

        $quiz = Quiz::create([
            'course_id' => $course->id,
            'description' => 'A Quiz to Test Your Might!',
            'quizTime' => '20',
            'startDate' => '10.29.2015',
            'endDate' => '10.30.2015'
            ]);

        $this->command->info('Quiz Created!');

        //Questions
        $q = Question::create([
            'prompt' => 'What is the sqare root of 4?',
            'difficulty' => 'easy',
            ]);
        $q1 = Question::create([
                    'prompt' => 'What is 2 X 3?',
                    'difficulty' => 'easy',
                    ]);

        $this->command->info('2 Questions Created!');
        //Answers
        $a = Answer::create([
            'text' => '6',
            'image' => NULL,
            ]);
        $a1 = Answer::create([
            'text' => '2',
            'image' => NULL,
            ]);
        $a2 = Answer::create([
            'text' => '6',
            'image' => NULL,
            ]);
        $a11 = Answer::create([
            'text' => '5',
            'image' => NULL,
            ]);

        $this->command->info('All 4 Answers Created!');

        // Adding User to Course
        $course->users()->sync([$student1->id, $student2->id]);

        // Syncing Quiz to Questions
        $quiz->questions()->sync([$q->id, $q1->id]);

        // Syncing (Binding Qustion to Answer)
        $q->answers()->sync([$a->id, $a1->id]);
        $q1->answers()->sync([$a2->id, $a11->id]);

        $this->command->info('Everything Created and Linked!');
        Model::reguard();
    }
}
