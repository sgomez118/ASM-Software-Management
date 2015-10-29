@extends('layouts.home')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
        {!! Form::open(array('url' => 'questions')) !!}
            
        <div class="form-group">
            {!! Form::label('Input Your Question') !!}
            {!! Form::text('promt', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "What's your question?" )) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Select Difficulty') !!}
            {!! Form::select('difficulty', array(
                    'easy' => 'Easy',
                    'medium' => 'Medium',
                    'hard' => 'Hard' )) !!}
        </div>
        {!! Form::close() !!}
    </div>

    <!-- TODO: Current Tasks -->


@endsection