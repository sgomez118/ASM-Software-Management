@section('quesitons')
<ul class="nav nav-tabs nav-stacked col-lg-2 col-md-2 col-sm-2">
  <?php $count = 0; ?>
  @foreach(App\Subject::all() as $subject)
    @if($count == 0)
    <li role="presentation" class="active"><a href="#quiz_{{ $subject->name }}" aria-controls="{{ $subject->name }}" role="tab" data-toggle="tab">{{ $subject->name }}</a></li>
    @else
    <li role="presentation" ><a href="#quiz_{{ $subject->name }}" aria-controls="{{ $subject->name }}" role="tab" data-toggle="tab">{{ $subject->name }}</a></li>
    @endif
    <?php $count++; ?>
  @endforeach
  </ul>
  <div class="tab-content col-lg-10 col-md-10 col-sm-10 ">
    <?php $quizCount = 0; ?>
    @foreach(App\Subject::all() as $subject)
      <div role="tabpanel" class="tab-pane <?php if ($quizCount==0): echo 'active'?><?php endif ?>" id="quiz_{{ $subject->name }}">
        <?php $quizCount = 1; ?>
        @if($subject->questions()->count() != 0)
          @foreach($subject->questions()->paginate(10) as $question)
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
          @endforeach
          {!! $subject->questions()->render() !!}
        @else
          <p>No questions for this class</p>
        @endif
        <div class="pull-right">
              <a href="/question/create"><button class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Quiz</button></a>
        </div>
      </div>
    @endforeach

  </div>
<!-- <div class="container"> -->

<!-- </div> -->
@show