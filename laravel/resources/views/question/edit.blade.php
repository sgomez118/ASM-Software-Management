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

@if($question->type == "single" || $question->type == "multi-value")
    Yes, this works.  
@endif
               
          
@if($question->type == "single" || $question->type == "multi-value")               
    {!! Form::model($question, array('route' => array('question.update', $question->id), 'method' => 'put')) !!} 
<input type="hidden" value="{{$question->type}}" name="type">    
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

@elseif($question->type == "true-false")
    {!! Form::model($question, array('route' => array('question.update', $question->id), 'method' => 'put')) !!} 
    <input type="hidden" value="{{$question->type}}" name="type">   
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
         @for($q = 1; $q <= 2; $q++)
        <div class="form-group">
            <div class="col-md-6 control-label">
                <label class="checkbox-inline">
                    <input type="checkbox" id="isCorrect{{ $q }}" name="isCorrect{{ $q }}" value="1"> 
                    {{-- Display either true or false --}}
                    @if($q == 1) 
                        True
                    @else
                        False
                    @endif
                </label>  
            </div>
            <div class="col-md-9">
                <textarea name="choice{{ $q }}" rows="5" required="required" class="form-control option">Put Comments Here</textarea>
            </div>
        </div>
        @endfor
    </div>
    
@else
    {!! Form::model($question, array('route' => array('question.update', $question->id), 'method' => 'put')) !!} 
<input type="hidden" value="{{$question->type}}" name="type">   
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
    
    Rewrite the answer key: 
    @for($q = 1; $q <= 1; $q++)
        <div class="form-group">
            <div class="col-md-3 control-label">
                <label>
                    Answer Key
                </label>  
            </div>
            <div class="col-md-9">
                <textarea name="choice{{ $q }}" rows="5" required="required" class="form-control option"></textarea>
            </div>
        </div>
    @endfor
    
@endif

    {!! Form::submit('Edit the Question!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}

            </div>
        </div>

@endsection