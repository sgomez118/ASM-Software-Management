{{-- Create a true false question --}}

@extends('layouts.home')

@section('content')
<br>
    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
    <div class="panel-heading text-center">Create True/False Question
    </div>
    <div class="panel-body">  
    <p class="text-center">Input the true/false question you want to create. Select exactly one option (true/false) for the correct answer </p>
    
        {!! Form::open(array('url' => 'save_true_false_question', 'class' => 'form-horizontal', 'role' => 'form')) !!}
            
        <div class="form-group">
            {!! Form::label("Question: ", null, array('class' => 'col-md-3 control-label')) !!}
            <div class="col-md-9">
            {!! Form::textarea('prompt', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "What's your  question?" )) !!}
            </div>
        </div>
        <div class="form-group">
    Total score:  
    {!! Form::number('total_score', 1) !!}
    </div>
        <input type="hidden" name="difficulty" id="myType"/>
        <div class="form-group">
            <label class="col-md-3 control-label">Difficulty</label>
            <div class="dropdown col-md-8">
                <input type="submit" value="Choose Difficulty" class="btn btn-default selectpicker dropdown-toggle"  id="difficultyMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"/>
                <ul class="dropdown-menu inner selectpicker" role='menu' aria-labelledby="difficultyMenu">
                    <li value='easy'><a href="#">Easy</a></li>
                    <li value='medium'><a href="#">Medium</a></li>
                    <li value='hard'><a href="#">Hard</a></li>
                </ul>
            </div>
        </div>
        
        {{-- Modified from question.create --}}
        @for($q = 1; $q <= 2; $q++)
        <div class="form-group">
            <div class="col-md-6 control-label">
                <label class="checkbox-inline">
                    <input type="checkbox" id="isCorrect{{ $q }}" name="isCorrect{{ $q }}" value="1"> 
                    {{-- Display either true or false --}}
                    @if($q == 1) 
                        True
                    @else
                        False
                    @endif
                </label>  
            </div>
            <div class="col-md-9">
                <textarea name="choice{{ $q }}" rows="5" required="required" class="form-control option">Put Comments Here</textarea>
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


