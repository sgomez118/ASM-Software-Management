@extends('layouts.home')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Register</div>
				<div class="panel-body">
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

					{!! Form::open(array('url' => 'auth/register', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="form-group">
							{!! Form::label('First Name', null, array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('first_name', null, 
									array('required', 
				                    	'class' => 'form-control',
				                    	'placeholder' => "First Name",
				                    	'value' => old('first_name')
				                )) !!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('Last Name', null, array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('last_name', null, 
									array('required', 
				                    	'class' => 'form-control',
				                    	'placeholder' => "Last Name",
				                    	'value' => old('last_name')
				                )) !!}
							</div>
						</div>
						
						<div class="form-group">
							{!! Form::label('E-Mail Address', null, array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::text('email', null, 
									array('required', 
				                    	'class' => 'form-control',
				                    	'placeholder' => "example@email.com",
				                    	'value' => old('email')
				                )) !!}
							</div>
						</div>
						<input type="hidden" name="type" id="myType">
						<div class="form-group">
							<label class="col-md-4 control-label">Type</label>
							<div class="dropdown col-md-6">
						  		<input type="submit" value="Choose Type" class="btn btn-default selectpicker dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							  	<ul class="dropdown-menu inner selectpicker" role='menu' aria-labelledby="dropdownMenu1">
							    	<li value='student'><a href="#">Student</a></li>
							    	<li value='lecturer'><a href="#">Professor</a></li>
							    	<li value='chair'><a href="#">Chair</a></li>
							  	</ul>
							</div>
						</div>


						<div class="form-group">
							{!! Form::label('Password', null, array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::password('password', 
									array('required', 
				                    	'class' => 'form-control',
				                    	'placeholder' => "password"
				                )) !!}
							</div>
						</div>

						<div class="form-group">
							{!! Form::label('Confirm Password', null, array('class' => 'col-md-4 control-label')) !!}
							<div class="col-md-6">
								{!! Form::password('password_confirmation', 
									array('required', 
				                    	'class' => 'form-control',
				                    	'placeholder' => "confirm password"
				                )) !!}
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
						 		{!! Form::submit('Register', array('class' => 'btn btn-primary')); !!}
							</div>
       					</div>
        			{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>        
@endsection
