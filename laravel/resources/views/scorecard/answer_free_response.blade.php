

@section('free-response')
    {!! Form::open(array('url' => '/take_quiz', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        {{-- $question_count --}}<strong>{{$question->prompt}}</strong>
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