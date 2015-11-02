@extends('layouts.home')

@section('content')

        <div class="container">
            <div class="content">
                <H1>Quiz List</H1>
                <!-- 
                    Iterates through the questions passed by the routes. 
                    Prints the prompt, difficulty and all the answers. 

                    foreach - laravel special function for blade
                    /{/{/}/} - equivalent of php echo. 
                        Note: there are others that can be used.
                -->
                {{-- Still need to display basic question info for each quiz --}}
                
                @foreach($quizzes as $quiz)
                    Course ID: {{$quiz->course_id}} <br>
                    Description: {{$quiz->description}} <br>
                    Time Limit: {{$quiz->quizTime}} <br>
                    Start Date: {{$quiz->startDate}} <br>
                    End Date: {{$quiz->endDate}} <br>
                    Quiz Questions: 
                        @foreach($quiz->questions as $question)
                           <li> {{ $question->prompt }} </li>
                        @endforeach
                    <br>
                    <br>
                @endforeach
                </ol>
            </div>
        </div>

@endsection


