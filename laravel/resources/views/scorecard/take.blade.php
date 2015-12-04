@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  @include('scorecard._question')
  @include('scorecard._instructions')
  @if(Session::has('scorecardID'))
  	<?php $goto = 'question' ?>
  @else
  	<?php $goto = 'instructions' ?>
  @endif
    @section($goto)
    @show
  </div>
</div>
@endsection