{{-- Display ScoreCard information --}}
{{-- Need to pass in a score card to this view --}}

<html>
    <div class="container">
        <div class="content">
            <H1>Score Card Information</H1>
                
            ID = {{ $scoreCard->id }} <br>
            QuizID = {{ $scoreCard->quiz_id }}<br>
            UserID = {{ $scoreCard->user_id }}<br>
            Score = {{ $scoreCard->score }} <br>
            Status = {{ $scoreCard->is_taken }} <br>
            <br>
            
            <H2> Student Answers: </H2> <br>
            @foreach($scoreCard->answer_questions as $student_answer)
                Student Answer ID = {{ $student_answer->id }} <br>
                Question ID = {{ $student_answer->question_id }} <br>
                Answer ID = {{ $student_answer->answer_id }} <br>
                Is it correct (0 for no, 1 for yes)? = {{ $student_answer->is_correct }} <br>
                <br>

            @endforeach
            
            
            </div>
        </div>
</html>
