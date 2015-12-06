@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  @include('scorecard._question')
    @section('question')
    @show
  </div>
</div>
@endsection