@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  
  
  @if($question->type == 'free-response')
      @include('scorecard.answer_free_response')
  free response
     @section('free-response')
  @else
      not free response
      @include('scorecard._question')
  @section('question')
  
  @endif
     
    @show
  </div>
</div>
@endsection