@section('course')
	<ul class="nav nav-tabs nav-stacked col-md-2 col-sm-2">
	<?php $count = 0; ?>
	@foreach(App\User::getCourses(Auth::user()->id) as $course)
		@if($count == 0)
		<li role="presentation" class="active"><a href="#{{ $course->name }}" aria-controls="{{ $course->name }}" role="tab" data-toggle="tab">{{ $course->name }}</a></li>
		@else
		<li role="presentation" ><a href="#{{ $course->name }}" aria-controls="{{ $course->name }}" role="tab" data-toggle="tab">{{ $course->name }}</a></li>
		@endif
		<?php $count++; ?>
	@endforeach
	</ul>
	<br>
	<div class="tab-content col-md-10 col-sm-10 ">
		<?php $studentCount = 0; ?>
		@foreach(App\User::getCourses(Auth::user()->id) as $course)
		<div role="tabpanel" class="tab-pane <?php if ($studentCount==0): echo 'active'?><?php endif ?>" id="{{ $course->name }}">
			<?php $studentCount = 1; ?>
			<table class="table table-striped">
				<thead>
					<th>#</th>
					<th>Name</th>
					<th>Email</th>
					<th>Grade</th>
				</thead>
				<tbody>
					@foreach($course->users as $student)
					<tr>
						<td>{{ $studentCount }}</td>
			 			<td><a href="#{{ $student->name }}" aria-controls="{{ $student->name }}" role="tab" data-toggle="tab">{{ $student->name }}</a></td>
						<td>{{ $student->email }}</td>
						<td>A</td>
					<?php $studentCount++; ?>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		@endforeach
	</div>

@show