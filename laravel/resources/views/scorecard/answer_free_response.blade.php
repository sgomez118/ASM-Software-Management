

@section('free-response')
Does this even display?  OMG it is not displaying anything!
<h1>Free Response Question with Question id: {{ $question->id }} </h1>
<h1>    Subject ID: {{ $question->subject_id }} </h1>
<h1>    Prompt: {{ $question->prompt }}</h1>
<h1>    Difficulty: {{ $question->difficulty }}</h1>
<h1>    Type: {{ $question->type }}</h1>
<h1>    Total Score: {{ $question->total_score }}</h1>

    {!! Form::open(array('url' => '/take_quiz', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        <strong>{{$question->prompt}}</strong>
      </div>
      <input type="hidden" name="qID" value="{{ $question->id }}">
      <div class="panel-body">
      
      <textarea name="response" rows="5" class="form-control option" placeholder="Enter your response here"> @if(isset($free_response)) {{ $free_response->response }} @endif </textarea>
      
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