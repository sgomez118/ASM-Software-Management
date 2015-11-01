@extends('layouts.home')

@section('content')
    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
        {!! Form::open(array('url' => 'save_q')) !!}
            
        <div class="form-group">
            {!! Form::label('Input Your Question') !!}
            {!! Form::text('prompt', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "What's your question?" )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Select Difficulty') !!}
            {!! Form::select('difficulty', array(
                    'easy' => 'Easy',
                    'medium' => 'Medium',
                    'hard' => 'Hard' )) !!}

            {!! Form::submit('Save') !!}
        </div>

        {!! Form::close() !!}
    </div>
@endsection