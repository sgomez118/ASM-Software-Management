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
            $this->command->info("Adding Question: ".$question_keys."..."); 
    		$answers = $question['answers'];
    		unset($question['answers']);
        	$q = new Question($question);
        	$q->save();
        	foreach ($question as $question_attribute_name => $question_attribute_value) {
            	$this->command->info($question_attribute_name); 
        	}
            if($q->type == "true-false"){
                $this->command->info("Adding True/False Question..."); 
                $answer = $question['answer'];
                $aFalse;
                $aTrue;
                if(Answer::where('text', 'true')->count() >= 1){
                    $aTrue = Answer::where('text', 'true')->first();
                }else{
                    $aTrue = new Answer(['text'=> 'true']);
                    $aTrue->save();
                }
                if(Answer::where('text', 'false')->count() >= 1){
                    $aFalse = Answer::where('text', 'false')->first();
                }else{
                    $aFalse = new Answer(['text'=> 'false']);
                    $aFalse->save();
                }
                $q->answers()->save($aFalse, ['is_correct' => ($answer ? 0 : 1)]);
                $q->answers()->save($aTrue, ['is_correct' => ($answer ? 1 : 0)]);
            }else{
                $this->command->info("Adding answers..."); 
                
                
                $answer_ids = array();
                foreach ($answers as $answer_index => $answer) {
                    $this->command->info("Adding ".($answer_index + 1)."..."); 
                    $a = new Answer($answer);
                    $a->save();
                    $q->answers()->save($a, ['is_correct' => ($answer['is_correct']==="false" ? 0 : 1)]);
                }
            }
            $this->command->info(""); 
        }
    }
}
