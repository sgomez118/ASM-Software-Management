{{-- Displays all the questions --}}
@extends('user.professors.dashboard')

@section('view')
<div class="container">
  <div class="content" id="copypaste">
    <H1>Quiz Questions</H1>
      <ol>
        @foreach($questions as $question)
        <li> 
         <div class="panel panel-default">
           <div class="panel-heading clearfix">
              {{$question->prompt}}
              ( {{$question->total_score}} Points )
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
             @if($question->type == "free-response")
                 @foreach($question->answers as $answer)
                      Answer Key: {{$answer->text}}
                 @endforeach
             @elseif($question->type == "true-false")
             <ol style="list-style-type: lower-alpha"> 
                 @foreach($question->answers as $answer)
                 <li> 
                      @if($answer->pivot->is_correct == TRUE)
                       <span class="label label-success"> {{$answer->text}} </span>
                      @else
                          {{$answer->text}}
                      @endif
                 </li>
                 @endforeach
              </ol>
             @else
               <ol style="list-style-type: lower-alpha"> 
                 @foreach($question->answers as $answer)
                 <li> 
                      @if($answer->pivot->is_correct == TRUE)
                       <span class="label label-success"> {{$answer->text}} </span>
                      @else
                          {{$answer->text}}
                      @endif
                 </li>
                 @endforeach
               </ol>
             @endif
           </div>   
           <div class="panel-footer">       

           <div class="pull-right">
             
              {!! Form::open(array('route' => array('question.destroy', $question->id), 'method' => 'delete')) !!}
              <button class="btn btn-default" type="submit" >
                <span class="glyphicon glyphicon-remove" aria-hidden="true">
                </span>
                  Delete Question
              </button>
              {!! Form::close() !!}
           </div>         
                
              {{-- Clicking this takes them to edit update form --}}
              {!! Form::open(array('route' => array('question.edit', $question->id), 'method' => 'get')) !!}
              <button class="btn btn-default" type="submit" >
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
              Edit Question

              </button>
              {!! Form::close() !!}
           </div>
         </div> {{-- end panel --}} 
        </li>
        @endforeach
      </ol>
  </div>
  <div class="text-center">
    
  {!! $questions->render() !!}
  </div>
</div>
@endsection