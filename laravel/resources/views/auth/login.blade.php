@extends('layouts.home')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
        {{-- resources/views/auth/login.blade.php --}}
        {{-- The line below indicates that when the form is submitted, route associated with the /auth/login URL should be used; that route points to the AuthController, which does some authentication magic --}}
        {{-- Should I use Form::email()? --}}
        {{-- Method is POST, action is /auth/login --}}
        
        {!! Form::open(array('url' => '/auth/login')) !!}
            {!! csrf_field() !!}

        <div class="form-group">
            {!! Form::label('Email: ') !!}
            {!! Form::text('email', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "example@example.com" )) !!}
        </div>
        
        {{-- Need to check if the email is of valid format --}}

        <div class="form-group">
            {!! Form::label('Password: ') !!}
            {!! Form::password('password', array('required', 
                    'class' => 'form-control',
                    'placeholder' => "Your Password" )) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('Remember Me') !!}
            {!! Form::checkbox('remember') !!} 
        </div>
        
        <div class="form-group">
        {!! Form::submit('Login'); !!}
        </div>
        {!! Form::close() !!}
    </div>

    <!-- TODO: Current Tasks -->
@endsection