@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
<H1>Quiz Instructions</H1>
    {!! Form::open(array('url' => '/quiz_agree', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        Please read the instructions below.
      </div>
      <div class="panel-body">
      
      <ol>
      
      <li> One question per page will be displayed. </li>
      <li> Read the question carefully and follow any question prompt instructions </li>
      <li> For multiple choice questions, be aware that there may be more than one correct answer choice.  Select ALL correct answer choices. </li>
      <li> For true/false questions, select either "true" or "false" but not both. </li>
      <li> For free response questions, fill in the text area under the prompt. </li>
      <li> Once you are done answering the question, hit the "next" button </li>
      <li> You can navigate between questions by hitting the "next" (to go to the next question) and "prev" (to go to a previous question) buttons </li>
      <li> Time will continue to count down as you navigate. </li>
      <li> The quiz will end either when you run out of time or when you reach the last question and hit "next." </li>
      <li> Your multiple choice and true/false questions will be automatically graded at the end of the quiz.  Those results will be displayed on the screen </li>
      <li> Your responses to the free-response questions will be graded by a professor. </li>
      <li>When you are ready to take the quiz, click the "Agree &amp; Continue" button. </li>

      </ol>
      
      <div class="center-body"> GOOD LUCK! </div>
      
      </div>   
    </div> {{-- end panel --}}
    <div class="form-group  ">
      <div class="span6 text-center">
        <input type="submit" class="btn btn-primary" name="agree" value="Agree & Continue">
      </div>
    </div>
    {!! Form::close() !!}

    </div>
</div>
@endsection