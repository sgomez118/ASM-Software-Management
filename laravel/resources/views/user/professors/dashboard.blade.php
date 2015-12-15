@extends('layouts.home')

@section('content')
<div class="container-fluid" role="main">
	<h1>Welcome {{Auth::user()->first_name}}!</h1>
	@section('view')
	<div class="panel panel-default">
	<div class="panel-heading"><h3>Quizzes By Subject</h3></div>
		<div class="panel-body">
		@include('user.professors.quizzes')
	  </div>
	</div>
	@show
</div>
@endsection