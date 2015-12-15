@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  <br>
  <div class="jumbotron">
  <h1>Quiz Results</h1>
  <h2>Score: {{ ($scorecard->multi_choice_score/$scorecard->questions()->count())*100 }}%</h2>
  <p>Total Questions: {{ $scorecard->questions()->count() }}</p>
  <p>Total Correct: {{ $scorecard->multi_choice_score }}</p>
  </div>
 
</div>
</div>
@endsection