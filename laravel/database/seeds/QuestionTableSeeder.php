<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class QuestionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
            "questions":[{
                "prompt" : "Which of the following operations are NOT part of the Abstract Data Type Stack? ",
                "difficulty": "easy", 
                "type": "multiple", 
                "total_score" : "1",
                "subject_id": "2",
                "image": "stack picture", 
                
                "answers":[
                {
                    "text": "push()", 
                    "image": "push image", 
                    "is_correct" : "false"
                },
                {
                    "text": "reverse()", 
                    "image": "reverse operation picture", 
                    "is_correct" : "true"
                },
                {
                    "text": "getFirstElement()", 
                    "image": "image of first element", 
                    "is_correct" : "true"
                },
                {
                    "text": "pop()", 
                    "image": "image of popping!!!", 
                    "is_correct" : "false"
                },
                {
                    "text": "rotate", 
                    "image": "image of rotation", 
                    "is_correct" : "true"
                }

                ]
            },
            
            {
                "prompt" : "What is the storage policy for a Stack?",
                "difficulty": "easy", 
                "type": "single", 
                "total_score" : "1",
                "subject_id": "2",
                "image": "stack picture", 
                
                "answers":[
                {
                    "text": "LIFO", 
                    "image": "LIFO image", 
                    "is_correct" : "true"
                },
                {
                    "text": "FIFO", 
                    "image": "FIFO image", 
                    "is_correct" : "false"
                },
                {
                    "text": "NEMO", 
                    "image": "NEMO image", 
                    "is_correct" : "false"
                },
                {
                    "text": "NOMO", 
                    "image": "NOMO image", 
                    "is_correct" : "false"
                },
                {
                    "text": "LIMO", 
                    "image": "Vroooooooom!!!!", 
                    "is_correct" : "false"
                }

                ]
            }
            
            
            
            ]
        }';
            
            
            $questions = json_decode($string, true);
            // $questions is a array of questions
            // iterate through array
            // print out all information to test
            // $this->command->info('Course Created!');
            
            foreach($questions['questions'] as $i => $v)
            {
                $this->command->info($v); // prints out all stuff to screen
            }
            
            
            
            
        /*
            $area = json_decode($string, true);

            foreach($area['area'] as $i => $v)
            {
                echo $v['area'].'<br/>';
            }
        */
    }
}
