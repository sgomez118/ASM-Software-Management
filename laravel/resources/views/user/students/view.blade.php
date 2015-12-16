@extends('layouts.home')

@section('content')
<div class="container">
	<div class="content">
		<div class="panel panel-default">
			<div class="panel panel-heading">
				
			</div>
			<div class="panel panel-body">
				<div class="form-group pull-right">
    <input type="text" class="search form-control" placeholder="What you looking for?">
</div>
<span class="counter pull-right"></span>
<table class="table table-hover table-bordered results">
  <thead>
    <tr>
      <th>#</th>
      <th class="col-md-4 col-xs-4">First Name</th>
      <th class="col-md-4 col-xs-4">Last Name</th>
      <th class="col-md-3 col-xs-3"># of Test</th>
      <th class="col-md-1 col-xs-1"></th>
    </tr>
    <tr class="warning no-result">
      <td colspan="4"><i class="fa fa-warning"></i> No result</td>
    </tr>
  </thead>
  <tbody id="myTable">
  <?php $count = 1 ?>
    	@foreach($students as $student)
    <tr>
      <th scope="row">{{ $count++ }}</th>
      <td>{{ $student->first_name }}</td>
      <td>{{ $student->last_name }}</td>
      <td>{{ $student->scoreCards()->count() }}</td>
      <td>
	        <form action="/student/{{ $student->id }}" method="GET" role="form" class="form-inline">
	            <button class="btn btn-default"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></button>
	        </form> 
	        <form action="/student/{{ $student->id }}/edit" method="GET" role="form" class="form-inline">
	            {{ csrf_field() }}
	            {{ method_field('PUT') }}
	            <button class="btn btn-default"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
	        </form> 
			<form action="/student/{{ $student->id }}" method="POST" role="form" class="form-inline">
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
			<div class="col-md-12 text-center">
      <ul class="pagination" id="myPager"></ul>
      </div>
		</div>
	</div>
</div>
@endsection