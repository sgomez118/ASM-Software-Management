@extends('layouts.home')

@section('content')
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Login</div>
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

					{!! Form::open(array('url' => '/auth/login', 'method' => 'post', 'class' => 'form-horizontal', 'role' => 'form')) !!}
            			{!! csrf_field() !!}
            			<div class="form-group">
				            {!! Form::label('E-Mail Address',null,  array('class' => 'col-md-4 control-label')) !!}
				            <div class="col-md-6">
				            	{!! Form::text('email', null, 
				            		array('required', 
				            			'class' => 'form-control',
				            			'placeholder' => "example@example.com",
				            			'value'=> old('email')
				            	 )) !!}
				            </div>
				        </div>
                    
				        <div class="form-group">
				            {!! Form::label('Password',null,  array('class' => 'col-md-4 control-label')) !!}
				            <div class="col-md-6">
				            	{!! Form::password('password', 
				            		array('required', 
				            			'class' => 'form-control',
				            			'placeholder' => "Your Password"
				            	 )) !!}
				            </div>
				        </div>

				        <div class="form-group">
				            <div class="col-md-6 col-md-offset-4">
				            	{!! Form::checkbox('remember') !!}
				            	{!! Form::label('Remember Me') !!}
				            </div>
				        </div>

				        <div class="form-group">
				            <div class="col-md-6 col-md-offset-4">
				            	{!! Form::submit('Login', array('class' => 'btn btn-primary')); !!}
				            	<a class="btn btn-link" href="{{ url('/email') }}">Forgot Your Password?</a>
				            </div>
				        </div>

            		{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
