<?php

use Illuminate\Database\Seeder;
use App\Answer;
use App\Question;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = '{
            "questions":[{
                "prompt" : "Which of the following operations are NOT part of the Abstract Data Type Stack?",
                "difficulty": "easy", 
                "type": "multiple", 
                "total_score" : "1",
                "subject_id": "1",
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
                "total_score" : "1",
                "subject_id": "1",
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
        ]}';
        $questions = json_decode($json, true);
        foreach($questions['questions'] as $question_keys => $question){
            $this->command->info("Adding Question".$question_keys."..."); 
    		$answers = $question['answers'];
    		unset($question['answers']);
        	$q = new Question($question);
        	$q->save();
        	foreach ($question as $question_attribute_name => $question_attribute_value) {
            	$this->command->info($question_attribute_name); 
        	}

    		$this->command->info("Adding answers..."); 
            $answer_ids = array();
			foreach ($answers as $answer_index => $answer) {
    			$this->command->info("Adding ".($answer_index + 1)."..."); 
				$a = new Answer($answer);
				$a->save();
                $q->answers()->save($a, ['is_correct' => ($answer['is_correct']==="false" ? 0 : 1)]);
            }
            $this->command->info(""); 
        }
    }
}
