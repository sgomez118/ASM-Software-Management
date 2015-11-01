@extends('layouts.home')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation  csrf_field()  Errors@include('common.errors') -->
        
        @if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

        
        {{-- The line below indicates that when the form is submitted, route associated with the /save_user URL should be used; that route points to the UserController, which invokes its store method --}}
        {!! Form::open(array('url' => 'auth/register', 'method' => 'post')) !!}
            
        <div class="form-group">
            {!! Form::label('Name: ') !!}
            {!! Form::text('name', null, array('required', 
                    'class' => 'form-control',
                    'placeholder' => "Your Name Goes Here" )) !!}
        </div>
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
        
        
        {{-- originall had confirm_password instead of password_confirmation and this caused errors indicating that the password and confirm_password did not match in the form even though they did; Laravel convention needs password_confirmation for its logic --}}
        
        <div class="form-group">
            {!! Form::label('Confirm Password: ') !!}
            {!! Form::password('password_confirmation', array('required', 
                    'class' => 'form-control',
                    'placeholder' => "Your Password" )) !!}
        </div>
        
        {{-- Need to check if password is the same as what was entered in confirm password; blade uses special notation for conditionals --}}
            {{-- Use Laravel's Middleware thing and look at the Laravel 5 Essentials book on how to use it. It will most likely need to be put into a controller, perhaps the one that handles the storing procedure, since it is able to see the contents of the form.  Have the user controller perform some type of check and then redirect back to the page if there is an error --}}
        
        <div class="form-group">
            {!! Form::label('Type: ') !!}
            {!! Form::select('type', array(
                    'student' => 'Student',
                    'professor' => 'Professor',
            'chair' => 'Chair' ), null, array('class' => 'form-group')) !!}
        </div>
        
        <div class="form-group">
        {!! Form::submit('Create New User!'); !!}
        </div>
        {!! Form::close() !!}
    </div>

    <!-- TODO: Current Tasks -->
@endsection