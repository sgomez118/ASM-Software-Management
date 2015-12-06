@section('question')
<H1>Quiz</H1>
    {!! Form::open(array('url' => '/take_quiz', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>{{$question->prompt}}</strong>
      </div>
      <input type="hidden" name="qID" value="{{ $question->id }}">
      <div class="panel-body">
      <ol>
        @foreach($question->answers as $answer)
          <li type="A"><label>
          @if($selected_answers->contains($answer->pivot->id))
          <input type="checkbox" data-id="{{$answer->pivot->id}}" name='cb{{$answer->pivot->id}}' class="answers" value="1" checked> 
          @else
          <input type="checkbox" data-id="{{$answer->pivot->id}}" name='cb{{$answer->pivot->id}}' class="answers" value="1"> 
          @endif
          {{ $answer->text }}
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