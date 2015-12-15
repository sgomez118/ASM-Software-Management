@extends('layouts.home')

@section('content')
<div class="container" role="main">
	<h1>Welcome {{Auth::user()->name}}!</h1>
	<div class="panel panel-default">
		<div class="panel-body">
			<ul class="nav nav-pills span2">
				<li role="presentation" class="active"><a href="#quizzes" aria-controls="quizzes" role="tab" data-toggle="tab">Quizzes</a></li>
				<li role="presentation"><a href="#create-quiz" aria-controls="create-quiz" role="tab" data-toggle="tab">Create A Quiz</a></li>
				<li role="presentation"><a href="/create_quiz" aria-controls="take-quiz" role="tab" >Create A Quiz</a></li>
				<li role="presentation"><a href="/question/create" aria-controls="take-quiz" role="tab" >Create A Question</a></li>
			</ul>
			<br>
			<div class="tab-content">
				<div role="tabpanel" class="tab-pane active" id="quizzes">
					 <div class="panel panel-default">
						<div class="panel-body">
							@include('user.professors.quizzes')
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="create-quiz">
					<div class="panel panel-default">
						<div class="panel-body">
							@include('quiz.create')
						</div>
					</div>
				</div>
				<div role="tabpanel" class="tab-pane" id="take-quiz">
					<div class="panel panel-default">
						<div class="panel-body">
							
						</div>
					</div>
				</div>
			</div>
	  </div>
	</div>
</div>
@endsection