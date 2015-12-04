@section('instructions')
<H1>Quiz Instructions</H1>
    {!! Form::open(array('url' => '/take_quiz', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
    <div class="panel panel-default">
      <div class="panel-heading clearfix">
        Please read the instructions below.
      </div>
      <div class="panel-body">
      <p>Instructions</p>
      </div>   
    </div> {{-- end panel --}}
    <div class="form-group  ">
      <div class="span6 text-center">
        <input type="submit" class="btn btn-primary" name="agree" value="Agree & Continue">
      </div>
    </div>
    {!! Form::close() !!}
@endsection