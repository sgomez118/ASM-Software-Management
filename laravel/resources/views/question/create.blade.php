@extends('layouts.home')

@section('content')
<br>
    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
    <div class="panel-heading text-center">Create Question
    </div>
    <div class="panel-body">  
    <p class="text-center">Input the question you want to create. Check at least one correct answer option.</p>
        {!! Form::open(array('url' => 'save_question', 'class' => 'form-horizontal', 'role' => 'form')) !!}
            
        <div class="form-group">
            {!! Form::label("Question: ", null, array('class' => 'col-md-2 control-label')) !!}
            <div class="col-md-10">
            {!! Form::text('prompt', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "What's your  question?" )) !!}
            </div>
        </div>
        
        <input type="hidden" name="difficulty" id="myType"/>
        <div class="form-group">
            <label class="col-md-2 control-label">Difficulty</label>
            <div class="dropdown col-md-8">
                <input type="submit" value="Choose Difficulty" class="btn btn-default selectpicker dropdown-toggle"  id="difficultyMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                <ul class="dropdown-menu inner selectpicker" role='menu' aria-labelledby="difficultyMenu">
                    <li value='easy'><a href="#">Easy</a></li>
                    <li value='medium'><a href="#">Medium</a></li>
                    <li value='hard'><a href="#">Hard</a></li>
                </ul>
            </div>
        </div>

        @for($q = 1; $q <= 5; $q++)
        <div class="form-group">
            <div class="col-md-2 control-label">
                <label class="checkbox-inline">
                    <input type="checkbox" id="isCorrect{{ $q }}" value="1"> Option {{ $q }} 
                </label>  
            </div>
            <div class="col-md-10">
                <textarea name="choice{{ $q }}" rows="5" required="required" class="form-control option"></textarea>
            </div>
        </div>
        @endfor

        

        <div class="form-group">
        <div class="col-md-6 col-md-offset-5">
        {!! Form::submit('Save Question', array('class' => 'btn btn-primary')); !!}
        </div>
        </div>

        {!! Form::close() !!}
    </div>
    </div>
    </div>
@endsection