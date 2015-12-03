@extends('layouts.home')

@section('content')
<div class="container" role="main">
<h1>Welcome {{ Auth::user()->first_name }}!</h1>
	<h2>Subjects</h2>
	<div class="panel panel-default">
	<table class="table table-striped">
		<thead>
			<td>Class</td>
			<td># of Professor</td>
			<td># of Students</td>
		</thead>
		<tbody>
			@foreach($subjects as $subject)
				<tr data-lecturerID="{{ $subject->lecturer_id }}" data-subjectID="{{ $subject->id }}">
					<td>{{ $subject->name }}</td>
					<td>{{ $subject->lecturers()->count() }}</td>
					<td>{{ $subject->users()->count() }}</td>
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