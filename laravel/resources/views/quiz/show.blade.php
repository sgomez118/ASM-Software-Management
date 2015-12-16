@extends('layouts.home')

@section('content')
<div class="container" role="main">
<h1>Quiz: {{ $quiz->title }}</h1>
<div class="panel panel-default">
	<div class="panel-heading">
	
		<button class="btn btn-primary" type="button">
		  Quiz Length <span class="badge">{{ $quiz->quiz_time }} min</span>
		</button>
	<div class="pull-right">
		<button class="btn btn-info" type="button">
		  Total Qustions <span class="badge">{{ $quiz->num_of_questions }}</span>
		</button>
	</div>
	</div>
		<div class="panel-body">
		<div class="row">
	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-primary">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-comments fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ $quiz->num_of_free_response}}</div>
	                            <div>Free Responses!</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="#">
	                    <div class="panel-footer">
	                        
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>
	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-green">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-tasks fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ $quiz->num_of_easy }}</div>
	                            <div>Easy Questions!</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="#">
	                    <div class="panel-footer">
	                        
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>
	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-yellow">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-shopping-cart fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ $quiz->num_of_medium }}</div>
	                            <div>Medium Questions!</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="#">
	                    <div class="panel-footer">
	                        
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>
	        <div class="col-lg-3 col-md-6">
	            <div class="panel panel-red">
	                <div class="panel-heading">
	                    <div class="row">
	                        <div class="col-xs-3">
	                            <i class="fa fa-support fa-5x"></i>
	                        </div>
	                        <div class="col-xs-9 text-right">
	                            <div class="huge">{{ $quiz->num_of_hard }}</div>
	                            <div>Hard Questions!</div>
	                        </div>
	                    </div>
	                </div>
	                <a href="#">
	                    <div class="panel-footer">
	                        
	                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
	                        <div class="clearfix"></div>
	                    </div>
	                </a>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	    	<div class="table-responsive">
	    		<table class="table table-striped">
	    			<thead>
	    				<td>#</td>
	    				<td>Name</td>
	    				<td>Sub Score</td>
	    				<td>Graded?</td>
	    				<td>Final Score</td>
	    			</thead>
	    			<tbody>
	    				<?php $count = 1 ?>
	    				@foreach($quiz->scoreCards()->orderBy('updated_at', 'desc')->get() as $sc)
	    				<tr>
	    				<td>{{ $count++ }}</td>
	    				<td>{{ App\User::find($sc->user_id)->first_name }} {{ App\User::find($sc->user_id)->last_name }}</td>
	    				<td>{{ number_format(($sc->multi_choice_score/$quiz->num_of_questions)*100, 2, '.', '') }} %</td>
	    				<td>@if($sc->free_response_score == 0) <a href="/quiz/grade/{{$sc->id}}">FALSE<a>@else TRUE @endif</td>
	    				<td>{{ $sc->score }}</td>
	    				</tr>
	    				@endforeach
	    			</tbody>
	    		</table>
	    	</div>
	    </div>

	  </div>
	</div>
</div>
@endsection