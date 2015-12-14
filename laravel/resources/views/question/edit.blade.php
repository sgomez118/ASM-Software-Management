{{-- Edit the specified question --}}
{{-- First do a basic display of the question --}}
{{-- Make each field editable? --}}

{{-- Show an individual Question --}}

@extends('layouts.home')

@section('content')
        <div class="container">
            <div class="content">
                <H1>Edit an Individual Question</H1>

                <ol>
                   <li> <div class="panel panel-default">
                   <div class="panel-heading clearfix">
                      
                      {{-- Can either delete or update --}}
                          {{-- Display delete button and question first --}}
                       {!! Form::open(array('route' => array('question.destroy', $question->id), 'method' => 'delete')) !!}
                      <button class="btn btn-danger" type="submit" >Delete Question</button>
                      {!! Form::close() !!}
                      

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
                   
                 </div> {{-- end panel --}} </li>
               </ol>
              This is the next part.  We test first if we can update all fields of a question.  Just put the create question form in here and see what happens.  
              
              The form view should be different if the question is multiple choice vs free response 
              
              Keep it simple; edit prompt only first.  
              
              
              {!! Form::model($question, array('route' => array('question.update', $question->id), 'method' => 'put')) !!}

    <div class="form-group">
        {!! Form::label('prompt', 'Prompt') !!}
        {!! Form::textarea('prompt', null, array('class' => 'form-control')) !!}
    </div>
    
    <div class="form-group">
    Select New Difficulty: 
    {!! Form::select('difficulty', array('easy' => 'Easy', 'medium' => 'Medium', 'hard' => 'Hard')) !!}
    </div>
    
    <div class="form-group">
    Input new total score
    {!! Form::number('total_score', $question->total_score) !!}
    </div>
    
    <div class="form-group">
    Rewrite the answer choices
        @for($q = 1; $q <= 5; $q++)
        <div class="form-group">
            <div class="col-md-2 control-label">
                <label class="checkbox-inline">
                    <input type="checkbox" id="isCorrect{{ $q }}" name="isCorrect{{ $q }}" value="1"> Option {{ $q }} 
                </label>  
            </div>
            <div class="col-md-10">
                <textarea name="choice{{ $q }}" rows="5" required="required" class="form-control option"></textarea>
            </div>
        </div>
        <br> <br>
        @endfor
    </div>

    {!! Form::submit('Edit the Question!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}
              
              
              
              
              
              
            </div>
        </div>

@endsection