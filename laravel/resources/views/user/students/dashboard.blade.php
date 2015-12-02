@extends('layouts.home')

@section('content')
<div class="container" role="main">
	<h1>Welcome {{Auth::user()->first_name}}!</h1>
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills">
			<li role="presentation" class="active"><a href="#scores" aria-controls="scores" role="tab" data-toggle="tab">Your Scores</a></li>
				<li role="presentation"><a href="#take-quiz" aria-controls="take-quiz" role="tab" data-toggle="tab">Take A Quiz</a></li>
			</ul>
			<br>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="scores">
					<div class="panel panel-default">
						<div class="panel-body">
							@if(Auth::user()->scoreCards()->where('is_available', '=', 0)->count() > 0)
								<table class="table table-striped">
								<thead>
									<th><tr>
										<td>Subject</td>
										<td>Test Title</td>
										<td>Score</td>
										<td>Quiz Time</td>
									</tr></th>
								</thead>
									<tbody>
								@foreach(Auth::user()->scoreCards as $scorecard)
									@if(!$scorecard->is_available)
										<tr>
											<td>{{ App\Subject::find(App\Quiz::find($scorecard->quiz_id)->subject_id)->name }}</td>
											<td>{{ App\Quiz::find($scorecard->quiz_id)->title }}</td>
											<td>{{ $scorecard->score }}%</td>
											<td>{{ App\Quiz::find($scorecard->quiz_id)->quiz_time }}</td>
										</tr>
									@endif
								@endforeach
									</tbody>
								</table>
							@else
								<p>No test scores to report at this time.</p>
							@endif
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="take-quiz">
					<div class="panel panel-default">
						<div class="panel-body">
							@if(Auth::user()->scoreCards()->where('is_available', '=', 1)->count() > 0)
								<table class="table table-striped">
								<thead>
									<th><tr>
										<td>Subject</td>
										<td>Test Title</td>
										<td>Quiz Time</td>
										<td></td>
									</tr></th>
								</thead>
									<tbody>
								@foreach(Auth::user()->scoreCards as $scorecard)
									@if($scorecard->is_available)
										<tr>
											<td>{{ App\Subject::find(App\Quiz::find($scorecard->quiz_id)->subject_id)->name }}</td>
											<td>{{ App\Quiz::find($scorecard->quiz_id)->title }}</td>
											<td>{{ App\Quiz::find($scorecard->quiz_id)->quiz_time }} mins</td>
											<td><a href="/take_quiz/{{ $scorecard->id }}">Take Quiz</a></td>
										</tr>
									@endif
								@endforeach
									</tbody>
								</table>
							@else
								<p>No test to take at this time.</p>
							@endif
						</div>
					</div>
				</div>
			</div>
	  </div>
	</div>
</div>
@endsection