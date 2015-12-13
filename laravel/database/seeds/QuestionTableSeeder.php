<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Question;
use App\Answer;
use App\Subject;

class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('classes')->insert([
        //     'name' => str_random(10),
        //     'term' => str_random(10).'@gmail.com',
        //     'lecturer_id' => 1,
        // ]);

        //$this->command->info('test');
         // string is a JSON that contains ALL of the questions we want to add to the database
        
        /** Question object has the following attributes: 
                subject_id
                prompt
                difficulty
                type
                image
                total_score
            
            We also want to associate the Question object with 5 Answer objects
            Answer objects contain: 
                text
                image
        
            Each Question will have 5 answer options total
        
            
        
        */ 
        
        // for consistency, everything is listed in the JSON in the order from diagram
        
        
        
        
        
        
        $string = '{
            "questions": [{
                "prompt" : "Which of the following operations are NOT part of the Abstract Data Type Stack? ",
                "difficulty": "easy", 
                "type": "multiple", 
                "total_score" : 1,
                "subject_id": 1,
                "image": null, 
                
                "answers":[
                {
                    "text": "push()", 
                    "image": null, 
                    "is_correct" : "false"
                },
                {
                    "text": "reverse()", 
                    "image": null, 
                    "is_correct" : "true"
                },
                {
                    "text": "getFirstElement()", 
                    "image": null, 
                    "is_correct" : "true"
                },
                {
                    "text": "pop()", 
                    "image": null, 
                    "is_correct" : "false"
                },
                {
                    "text": "rotate", 
                    "image": null, 
                    "is_correct" : "true"
                }

                ]
            },
            
            {
                "prompt" : "What is the storage policy for a Stack?",
                "difficulty": "easy", 
                "type": "single", 
                "total_score" : 1,
                "subject_id": 1,
                "image": null, 
                
                "answers":[
                {
                    "text": "LIFO", 
                    "image": null, 
                    "is_correct" : "true"
                },
                {
                    "text": "FIFO", 
                    "image": null, 
                    "is_correct" : "false"
                },
                {
                    "text": "NEMO", 
                    "image": null, 
                    "is_correct" : "false"
                },
                {
                    "text": "NOMO", 
                    "image": null, 
                    "is_correct" : "false"
                },
                {
                    "text": "LIMO", 
                    "image": null, 
                    "is_correct" : "false"
                }

                ]
            }
            
            
            
            ]

        }';

            // we can name an object, can't name array
            // so when we used square brackets above, couldn't name it
            
            
            $questions = json_decode($string, true);
            // $questions is a array of questions
            // iterate through array
            // print out all information to test
            // $this->command->info('Course Created!');
            // we didn't have any subjects in there at the time so created one
           // $s = new Subject(array('name' => 'Data Structures'));
           // $s->save();
            foreach($questions['questions'] as $i => $v)
            {
                $this->command->info("");
                $this->command->info("Making question: ".($i+1));
                $this->command->info("    Prompt: ".$v['prompt']);
                $this->command->info("    Difficulty: ".$v['difficulty']);
                $this->command->info("    Type: ".$v['type']);
                $this->command->info("    Total Score: ".$v['total_score']);
                $this->command->info("    Subject ID: ".$v['subject_id']);
                $this->command->info("    Image: ".$v['image']);
                
                // create the question
                $q = Question::create([
                    'prompt' => $v['prompt'], 
                    'difficulty' => $v['difficulty'],
                    'type' => $v['type'],
                    'total_score' => $v['total_score'],
                    'subject_id' => $v['subject_id'],
                    'image' => $v['image']
                    //'image' => ($v['image'] == "") ? null : $v['image']
                    
                    //$var_is_greater_than_two = ($var > 2 ? true : false); // returns true
                ]);
                $q->save();
                $this->command->info("    Answer Choices:");
                // print out all the answers for this question
                foreach($v['answers'] as $answerIndex => $answer)
                {
                    $a = new Answer($answer);
                    $a->save();
                    $q->answers()->sync([$a->id]);
                    $this->command->info("        Answer ID = ".$a->id);
                    
                    $this->command->info("        Option: ".$answer['text']);
                    $this->command->info("        Image: ".$answer['image']);
                    $this->command->info("        Is Correct: ".$answer['is_correct']);
                    $this->command->info("");
                }
                
            }
            
      
    }
}
