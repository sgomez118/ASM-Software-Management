@extends('layouts.home')

@section('content')
<div class="container">
  <div class="content">
  @include('scorecard._question')
  @include('scorecard._instructions')
  @if(Auth::user()->session()->has('agreed'))
  	<?php $goto = 'question' ?>
  @eles
  	<?php $goto = 'instructions' ?>
  @endif
    @section('question')
    @show
  </div>
</div>
@endsection