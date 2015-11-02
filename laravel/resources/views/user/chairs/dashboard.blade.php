@extends('layouts.home')

@section('content')
<div class="container" role="main">
<h1>Welcome {{Auth::user()->name}}!</h1>
	<h2>Classes</h2>
	<div class="panel panel-default">
	<table class="table table-striped">
		<thead>
			<td>Class</td>
			<td>Professor</td>
			<td># of Students</td>
		</thead>
		<tbody>
			@foreach($courses as $course)
				<tr data-lecturerID="{{ $course->lecturer_id }}" data-courseID="{{ $course->id }}">
					<td>{{ $course->name }}</td>
					<td>{{ App\User::find($course->lecturer_id)->name }}</td>
					<td>{{ $course->users()->count() }}</td>
				</tr>
			@endforeach
		</tbody>
</table>
	</div>
	<h2>Users</h2>
	<div class="panel panel-default">
		@include('user.chairs._allUsers')
	</div>
</div>
@endsection