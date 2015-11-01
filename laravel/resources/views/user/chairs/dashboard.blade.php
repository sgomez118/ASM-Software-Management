@extends('layouts.home')

@section('content')
<div class="container" role="main">
<h1>Welcome Chair!</h1>
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
</div>
@endsection