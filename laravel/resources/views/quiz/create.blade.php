
{{-- Trying to create a basic form for creating a quiz --}}
{{-- Make sure comments are not too long --}}

{{-- Dr. Tang wants us to pull questions from the question bank and put them together to make a quiz.  This means a quiz has the "hasMany" relationship to questions.  Check the Quiz model first.  
--}}

{{-- All the basics are here, but now the hard part is adding questions.  For now, I'm going to manually add one question.  For the final project, we pull the questions from the question bank.  

--}}

@extends('layouts.home')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
        <h1> Create a Quiz! </h1>
        
        {!! Form::open(array('url' => 'save_quiz')) !!}
            
        <div class="form-group">
            {!! Form::label('Enter Course ID: ') !!}
            {!! Form::text('course_id', null, array('required', 
                    'class' => 'form-control',
             )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Description: ') !!}
            <br>
            {!! Form::text('description', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Time Limit: ') !!}
            <br>
            {!! Form::text('quizTime', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Start Date: ') !!}
            <br>
            {!! Form::text('startDate', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('End Date: ') !!}
            <br>
            {!! Form::text('endDate', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Save Quiz!'); !!}
        </div>
        {!! Form::close() !!}
    </div>

    <!-- TODO: Current Tasks -->


@endsection


