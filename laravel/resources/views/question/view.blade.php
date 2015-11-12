{{-- Displays all the questions --}}
@extends('layouts.home')

@section('content')
        <div class="container">
            <div class="content">
                <H1>Quiz Questions</H1>
                <ol>
                  @foreach($questions as $question)
                   <li> <div class="panel panel-default">
                   <div class="panel-heading clearfix">
                      {{$question->prompt}}
                      <div class="pull-right">
                       @if( $question->difficulty == "easy" )
                       <span class="label label-info">Easy</span>
                       @elseif( $question->difficulty == "medium" )
                       <span class="label label-warning">Medium</span>
                       @else
                       <span class="label label-danger">Hard</span>
                       @endif
                     </div>
                   </div>
                   <div class="panel-body">
                     <ol style="list-style-type: lower-alpha"> 
                       @foreach($question->answers as $answer)
                       <li> {{$answer->text}} </li>
                       @endforeach
                     </ol>
                   </div>   
                   
                 </div> {{-- end panel --}} </li>
                 @endforeach
               </ol>
            </div>
        </div>

@endsection