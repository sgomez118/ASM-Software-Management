{{-- Form to create a course --}}

@extends('layouts.home')

@section('content')
    <div class="panel-body">        
        <h1> Create a Course! </h1>
        {!! Form::open(array('url' => 'save_course')) !!}
            
        <div class="form-group">
            {!! Form::label('Name: ') !!}
            {!! Form::text('name', null, array('required', 
                    'class' => 'form-control',
             )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Term: ') !!}
            <br>
            {!! Form::text('term', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Lecturer ID: ') !!}
            <br>
            {!! Form::text('lecturer_id', null, array('required', 
                    'class' => 'form-control'
                     )) !!}
        </div>

        <div class="form-group">
        {!! Form::submit('Save Course!'); !!}
        </div>
        {!! Form::close() !!}
    </div>

@show




