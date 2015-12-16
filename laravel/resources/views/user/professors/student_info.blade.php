@extends('layouts.home')

@section('content')
<div class="container">
<div class="row">

<h2>Student Info</h2>
	<div class="panel panel-default">
		<div class="panel panel-heading">
		Name: {{ $student->first_name}} {{ $student->last_name}}
			<div class="pull-right"><a href="/register/student/{{ $student->id }}">Add Quiz</a></div>
		</div>
		<div class="panel panel-body">
			<div class="table-responsive">
				<table>
					<thead>
						<th class="col-md-1 col-xs-1">#</th>
						<th class="col-md-8 col-xs-8">Test</th>
						<th class="col-md-2 col-xs-2">Score</th>
						<th class="col-md-1 col-xs-1"></th>
					</thead>
					<tbody>
					<?php $count = 1; ?>
					  @foreach($student->scoreCards()->orderBy('created_at')->get() as $sc)
						<tr>
							<td class="col-md-1 col-xs-1">{{ $count++ }}</td>
							<td class="col-md-8 col-xs-8">{{ App\Quiz::find($sc->quiz_id)->title }}</td>
							<td class="col-md-3 col-xs-3">
								@if($sc->is_available == true)
									<a href="#">Not Taken</a>
								@elseif( App\Quiz::find($sc->quiz_id)->num_of_free_response > 0)
									@if($sc->free_response_score > 0)
									{{ $sc->score }}
									@else
									<a href="/quiz/grade/{{ $sc->id}}">Needs Grading</a>
									@endif
								@else
									<a href="#">{{ $sc->score }}</a>
								@endif
							</td>
							<td>
								<!-- <form action="/student/remove_quiz/ $sc->id " method="POST">
						         csrf_field() 
						            <button class="btn btn-default"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
						        </form> -->
							</td>
						</tr>
					  @endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	
	<div class="content-fluid ">
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
						</thead>
						<tbody>
							@foreach($subject->quizzes as $quiz)
								<tr>
									<td>{{ $quizCount++ }}</td>
						 			<td><a href="/quiz/{{ $quiz->id }}" aria-controls="{{ $quiz->id }}">{{ $quiz->title }}</a></td>
									<td>{{ $quiz->quiz_time }}</td>
									<td>{{ $quiz->num_of_questions }}</td>
									<td>{{ $quiz->num_of_easy }}</td>
									<td>{{ $quiz->num_of_medium }}</td>
									<td>{{ $quiz->num_of_hard }}</td>
								    <td>
								        <form action="/student/add_quiz/{{ $quiz->id }}" method="GET">
								        {{ csrf_field() }}
								        {{ method_field('PUT') }}
								        	<input type='hidden' name='student_id' value='{{$student->id}}'>
								            <button class="btn btn-default"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
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
</div>
</div>
@endsection