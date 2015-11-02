@extends('layouts.home')

@section('content')
<div class="container" role="main">
	<h1>Welcome {{Auth::user()->name}}!</h1>
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
							You haven't taken any quiz!
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