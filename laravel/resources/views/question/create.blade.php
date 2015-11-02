@extends('layouts.home')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
        {!! Form::open(array('url' => 'save_question')) !!}
            
        <div class="form-group">
            {!! Form::label("Input your Question: ") !!}
            {!! Form::text('prompt', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "What's your  question?" )) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Select Difficulty') !!}
            {!! Form::select('difficulty', array(
                    'easy' => 'Easy',
                    'medium' => 'Medium',
                    'hard' => 'Hard' )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Answer Choice 1: ') !!}
            <br>
            Is this the correct answer?
            {!! Form::checkbox('isCorrect1', '1') !!} 
            {!! Form::text('choice1', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Answer Choice 2: ') !!}
            <br>
            Is this the correct answer?
            {!! Form::checkbox('isCorrect2', '1') !!} 
            {!! Form::text('choice2', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Answer Choice 3: ') !!}
            <br>
            Is this the correct answer?
            {!! Form::checkbox('isCorrect3', '1') !!} 
            {!! Form::text('choice3', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Answer Choice 4: ') !!}
            <br>
            Is this the correct answer?
            {!! Form::checkbox('isCorrect4', '1') !!} 
            {!! Form::text('choice4', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Answer Choice 5: ') !!}
            <br>
            Is this the correct answer?
            {!! Form::checkbox('isCorrect5', '1') !!} 
            {!! Form::text('choice5', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Save Question'); !!}
        </div>
        {!! Form::close() !!}
    </div>

    <!-- TODO: Current Tasks -->


@endsection