

@section('question')
<H1>Quiz</H1>
    {!! Form::open(array('url' => '/take_quiz', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        {{$question->prompt}}
      </div>
      <input type="hidden" name="qID" value="{{ $question->id }}">
      <div class="panel-body">
        @foreach($question->answers as $answer)
          <label><input type="checkbox" data-id="{{$answer->pivot->id}}" name='cb{{$answer->pivot->id}}' class="answers" value="1">  {{$answer->text}}</label>
          <br>
        @endforeach
      </div>   
    </div> {{-- end panel --}}


    <div class="form-group">
      <div class="col-md-6">
      <input type="submit" class="btn btn-primary" name="prev" value="Prev">
      <input type="submit" class="btn btn-primary" name="next" value="Next">
<!--       {!! Form::submit('Prev', array('class' => 'btn btn-primary')); !!}
      {!! Form::submit('Next', array('class' => 'btn btn-primary')); !!} -->
        <!-- {!! Form::submit('Submit', array('class' => 'btn btn-primary')); !!} -->
      </div>
    </div>
    {!! Form::close() !!}
@endsection