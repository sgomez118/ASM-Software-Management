@section('quiz')
	<ul class="nav nav-tabs nav-stacked col-lg-2 col-md-2 col-sm-2">
	<?php $count = 0; ?>
	@foreach(App\Subject::all() as $subject)
		@if($count == 0)
		<li role="presentation" class="active"><a href="#quiz_{{ $subject->name }}" aria-controls="{{ $subject->name }}" role="tab" data-toggle="tab">{{ $subject->name }}</a></li>
		@else
		<li role="presentation" ><a href="#quiz_{{ $subject->name }}" aria-controls="{{ $subject->name }}" role="tab" data-toggle="tab">{{ $subject->name }}</a></li>
		@endif
		<?php $count++; ?>
	@endforeach
	</ul>
	<div class="tab-content col-lg-10 col-md-10 col-sm-10 ">
		<?php $quizCount = 0; ?>
		@foreach(App\Subject::all() as $subject)
			<div role="tabpanel" class="tab-pane <?php if ($quizCount==0): echo 'active'?><?php endif ?>" id="quiz_{{ $subject->name }}">
				<?php $quizCount = 1; ?>
				@if($subject->quizzes()->count() != 0)
				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<th>#</th>
							<th>Name</th>
							<th>Time Length</th>
							<th># of Questions</th>
							<th># of Easy</th>
							<th># of Medium</th>
							<th># of Hard</th>
							<th></th>
							<th></th>
							<th></th>
						</thead>
						<tbody>
							@foreach($subject->quizzes as $quiz)
								<tr>
									<td>{{ $quizCount++ }}</td>
						 			<td><a href="#{{ $quiz->id }}" aria-controls="{{ $quiz->id }}" role="tab" data-toggle="tab">{{ $quiz->title }}</a></td>
									<td>{{ $quiz->quiz_time }}</td>
									<td>{{ $quiz->num_of_questions }}</td>
									<td>{{ $quiz->num_of_easy }}</td>
									<td>{{ $quiz->num_of_medium }}</td>
									<td>{{ $quiz->num_of_hard }}</td>
								    <td>
								        <form action="/quiz/{{ $quiz->id }}" method="GET">
								            <button class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
								        </form>
							        </td>
							        <td>
								        <form action="/quiz/{{ $quiz->id }}/edit" method="GET">
								            {{ csrf_field() }}
								            {{ method_field('PUT') }}
								            <button class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
								        </form>
							        </td>
									<td>
										<form action="/quiz/{{ $quiz->id }}" method="POST">
								            {{ csrf_field() }}
								            {{ method_field('DELETE') }}
								            <button class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
								        </form>
								    </td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
				@else
					<p>No quizzes for this class</p>
				@endif
				<div class="pull-right">
			        <a href="/quiz/create"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Quiz</button></a>
				</div>
			</div>
		@endforeach
	</div>
@show