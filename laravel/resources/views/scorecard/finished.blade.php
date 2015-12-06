@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  <br>
  <div class="jumbotron">
  <h1>Quiz Results</h1>
  <h2>Score: {{ $scorecard->score }}%</h2>
  <p>Total Questions: {{ $scorecard->questions()->count() }}</p>
  <p>Total Correct: {{ $scorecard->total_correct }}</p>
  </div>
 
</div>
</div>
@endsection