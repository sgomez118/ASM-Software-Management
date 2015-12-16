@extends('layouts.home')

@section('content')
        <div class="container">
            <div class="content">
                <H1>Quiz List</H1>
                
                @foreach($quizzes as $quiz)
                
                {{-- Begin nice formatting with buttons --}}
                <div class="panel-footer">       

                <div class="pull-right">
             
              {!! Form::open(array('route' => array('quiz.destroy', $quiz->id), 'method' => 'delete')) !!}
              <button class="btn btn-default" type="submit" >
                <span class="glyphicon glyphicon-remove" aria-hidden="true">
                </span>
                  Delete Quiz
              </button>
              {!! Form::close() !!}
                </div>         
                
              {{-- Clicking this takes them to edit update form --}}
              {!! Form::open(array('route' => array('quiz.edit', $quiz->id), 'method' => 'get')) !!}
              <button class="btn btn-default" type="submit" >
              <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
              Edit Quiz

              </button>
              {!! Form::close() !!}
           </div>
           {{-- End nice formatting with buttons --}}
           
           {{-- Display the basic quiz information --}}
                    Quiz ID: {{$quiz->id}} <br>
                    Subject ID: {{$quiz->subject_id}} <br>
                    User ID: {{$quiz->user_id}} <br>
                    Title: {{$quiz->title}} <br>
                    Quiz Time: {{$quiz->quiz_time}} <br>
                    Number of Questions: {{$quiz->num_of_questions}} <br>
                    Start Date: {{$quiz->start_date}} <br>
                    End Date: {{$quiz->end_date}} <br>
                    Number of Easy Question: {{$quiz->num_of_easy}} <br>
                    Number of Medium Questions: {{$quiz->num_of_medium}} <br>
                    Number of Hard Questions: {{$quiz->num_of_hard}} <br>
                    

                    <br>
                    <br>
                @endforeach
            </div>
        </div>

@endsection


