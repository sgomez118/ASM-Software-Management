{{-- Need to modify this to display Quiz information --}}
    {{-- For now, it just displays all the questions --}}

@extends('layouts.home')

@section('content')

        <div class="container">
            <div class="content">
                <H1>Quiz Questions</H1>
                <!-- 
                    Iterates through the questions passed by the routes. 
                    Prints the prompt, difficulty and all the answers. 

                    foreach - laravel special function for blade
                    /{/{/}/} - equivalent of php echo. 
                        Note: there are others that can be used.
                -->
                
                <ol>
                @foreach($questions as $question)
                <div class="panel panel-default">
                    <li> <div class="panel-heading clearfix">
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


