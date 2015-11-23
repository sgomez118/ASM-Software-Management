@extends('quiz.take')

@section('question')
<H1>Quiz</H1>
    {!! Form::open(array('url' => '/taks_quiz?page', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    @foreach($questions as $question)
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        {{$question->prompt}}
      </div>
      <div class="panel-body">
        @foreach($question->answers as $answer)
          <label><input type="checkbox" name='{{$answer->pivot->id}}' class="answers">  {{$answer->text}}</label>
          <br>
        @endforeach
      </div>   
    </div> {{-- end panel --}}
    @endforeach

    <div class="row">
      {!! $questions->render() !!}
    </div>

    <div class="form-group">
      <div class="col-md-6">
        {!! Form::submit('Submit', array('class' => 'btn btn-primary')); !!}
      </div>
    </div>
    {!! Form::close() !!}
@endsection