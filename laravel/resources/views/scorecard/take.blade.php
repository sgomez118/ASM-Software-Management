@extends('layouts.home')

@section('navbar')
<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!-- <a class="navbar-brand active" href="#">AQS</a> -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        @if(Auth::check())
            <li class="active"><a href="#">{{ Auth::user()->last_name}}, {{Auth::user()->first_name }}</a></li>
        @endif
        <li><a href="#">Instructions<span class="sr-only">(current)</span></a></li>
        <li><a href="#"><span class="sr-only">(current)</span></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if(Auth::check())
        <div class="pull-right">
          <li><button  type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" style="
    margin-top: 7;
    margin-right: 7;
">End Test</button></li>
          
        </div>
        @else
          <li><a href="/login">Log in</a></li>
        @endif
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
    </nav>
@show

@section('content')
<div class="container">
  <div class="content">
  
  @if($question->type == 'free-response')
      @include('scorecard.answer_free_response')
     @section('free-response')
  @else
      @include('scorecard._question')
  @section('question')
  
  @endif
     
    @show

    <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>This is a large modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</div>
@endsection