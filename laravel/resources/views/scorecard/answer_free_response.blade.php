@extends('layouts.home')

@section('content')
Does this even display?  OMG it is not displaying anything!
<h1>Free Response Question with Question id: {{ $question->id }} </h1>
<h1>    Subject ID: {{ $question->subject_id }} </h1>
<h1>    Prompt: {{ $question->prompt }}</h1>
<h1>    Difficulty: {{ $question->difficulty }}</h1>
<h1>    Type: {{ $question->type }}</h1>
<h1>    Total Score: {{ $question->total_score }}</h1>

    {!! Form::open(array('url' => '/test/show_response', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>{{$question->prompt}}</strong>
      </div>
      <input type="hidden" name="qID" value="{{ $question->id }}">
      <div class="panel-body">
      <ol>
        @foreach($question->answers as $answer)
          <input type="checkbox" data-id="{{$answer->pivot->id}}" name='cb{{$answer->pivot->id}}' class="answers" value="1"> 

          {{$answer->text }}
          </label>
           </li>
        @endforeach
      </ol>
      </div>   
    </div> {{-- end panel --}}
    <div class="form-group  ">
      <div class="span6 text-center">
        <input type="submit" class="btn btn-primary" name="prev" value="Prev">
        <input type="submit" class="btn btn-primary" name="next" value="Next">
      </div>
    </div>
    {!! Form::close() !!}
@endsection