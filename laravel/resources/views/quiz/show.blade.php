{{-- Show an individual quiz --}}
@extends('layouts.home')

@section('content')
       <div class="container">
            <div class="content">
                <H1>View Individual Quiz Information</H1>
                <!-- 
                    Iterates through the questions passed by the routes. 
                    Prints the prompt, difficulty and all the answers. 

                    foreach - laravel special function for blade
                    /{/{/}/} - equivalent of php echo. 
                        Note: there are others that can be used.
                -->
                {{-- Question generation done on-the-fly when quiz is finally taken, not before; so can't view questions--}}
                
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
            </div>
        </div>

@endsection