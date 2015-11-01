{{-- Form to create a course --}}

@extends('layouts.home')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
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

    <!-- TODO: Current Tasks -->


@endsection




