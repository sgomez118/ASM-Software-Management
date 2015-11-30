@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  @include('quiz.question_experimental')
    @section('question')
    @show
  </div>
</div>

@endsection