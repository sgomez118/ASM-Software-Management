@section('quiz')
	<ul class="nav nav-tabs nav-stacked col-md-2 col-sm-2">
	<?php $count = 0; ?>
	@foreach(App\User::getCourses(Auth::user()->id) as $course)
		@if($count == 0)
		<li role="presentation" class="active"><a href="#quiz_{{ $course->name }}" aria-controls="{{ $course->name }}" role="tab" data-toggle="tab">{{ $course->name }}</a></li>
		@else
		<li role="presentation" ><a href="#quiz_{{ $course->name }}" aria-controls="{{ $course->name }}" role="tab" data-toggle="tab">{{ $course->name }}</a></li>
		@endif
		<?php $count++; ?>
	@endforeach
	</ul>
	<div class="tab-content col-md-10 col-sm-10 ">
		<?php $quizCount = 0; ?>
		@foreach(App\User::getCourses(Auth::user()->id) as $course)
			<div role="tabpanel" class="tab-pane <?php if ($quizCount==0): echo 'active'?><?php endif ?>" id="quiz_{{ $course->name }}">
				<?php $quizCount = 1; ?>
				@if($course->quizzes()->count() != 0)
					<table class="table table-striped">
						<thead>
							<th>#</th>
							<th>Name</th>
							<th>Time Length</th>
							<th># of Questions</th>
							<th>Start Date</th>
							<th>End Date</th>
						</thead>
						<tbody>
							@foreach($course->quizzes()->get() as $quiz)
								<tr>
									<td>{{ $quizCount++ }}</td>
						 			<td><a href="#{{ $quiz->id }}" aria-controls="{{ $quiz->id }}" role="tab" data-toggle="tab">{{ $quiz->description }}</a></td>
									<td>{{ $quiz->quizTime }}</td>
									<td>{{ $quiz->questions()->count() }}</td>
									<td>{{ $quiz->startDate }}</td>
									<td>{{ $quiz->endDate }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				@else
					<p>No quizzes for this class</p>
				@endif
			</div>
		@endforeach
	</div>
@show