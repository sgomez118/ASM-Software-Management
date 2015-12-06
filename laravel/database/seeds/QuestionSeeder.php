<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
        $json = Storage::get('questions.json');
        $this->command->info($json);
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
