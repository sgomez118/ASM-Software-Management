@extends('layouts.home')
<div class="container-fluid">
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Modify Quiz!</div>
                <div class="panel-body">
				@include('quiz.create')
				</div>
           </div>
        </div>
     </div>
</div>