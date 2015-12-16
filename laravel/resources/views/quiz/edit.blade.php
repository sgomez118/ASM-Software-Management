{{-- Edit a Quiz --}}

    {{-- Show the current quiz --}}
        {{-- Put form under it --}}
        
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
                   {{--  Start Date: quiz->start_date <br>
                    End Date: quiz->end_date <br> --}}
                    Number of Easy Question: {{$quiz->num_of_easy}} <br>
                    Number of Medium Questions: {{$quiz->num_of_medium}} <br>
                    Number of Hard Questions: {{$quiz->num_of_hard}} <br>
                    
                    <br>
                    <br>
            </div>
        </div>
        
        {{-- Put form for editing the quiz here --}}
        {{-- Based on the form for creating a quiz --}}
        
        {!! Form::model($quiz, array('route' => array('quiz.update', $quiz->id), 'method' => 'put', 'class' => 'form-horizontal')) !!}
        
        <div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit the Quiz!</div>
                <div class="panel-body">
                    <div class="form-group">
                        {!! Form::label('Title',
                        null,
                        array('class' => 'col-md-4 control-label')
                        )!!}
                        <div class="col-md-6">
                            {!! Form::text('title', 
                            null,
                            array('required', 'class' => 'form-control'
                            )) !!}
                        </div>
                    </div>

                    <input type="hidden" name="subject_id" id="myType">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Choose Subject</label>
                        <div class="dropdown col-md-6">
                            <input type="submit" value="Subject" class="btn btn-default selectpicker dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <ul class="dropdown-menu inner selectpicker" role='menu' aria-labelledby="dropdownMenu1">
                                @foreach(App\Subject::all() as $subject)
                                    <li value={{$subject->id}}><a href="#">{{$subject->name}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>                   

                    <div class="form-group">
                        {!! Form::label('Time Limit',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                            {{-- FUTURE: Break quiz time up into hours and minutes --}}
                            {!! Form::text('quiz_time', 
                            null, array('required', 
                            'class' => 'form-control',
                            'placeholder' => 'hours [ex. 1 hr 30 m = 1.5 hours]'
                            )) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('Number of Questions',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                            {!! Form::text('num_of_questions', 
                            null, array('required', 
                            'class' => 'form-control',
                            'placeholder' => "Max " . App\Question::all()->count()
                            )) !!}
                        </div>
                    </div>

          

                    <div class="form-group">
                        {!! Form::label('Easy',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                            
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">#</span>
                            <input type="text" name="num_of_easy" class="form-control"
                            placeholder="# of easy [Max {{App\Question::where('difficulty', 'easy')->get()->count()}}] (currently {{$quiz->num_of_easy}})" aria-describedby="basic-addon2">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Medium',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">#</span>
                            <input type="text" name="num_of_medium" class="form-control" 
                            placeholder="# of meduim [Max {{App\Question::where('difficulty', 'medium')->get()->count()}}] (currently {{$quiz->num_of_medium}})" aria-describedby="basic-addon2">
                        </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('Hard',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-addon" id="basic-addon2">#</span>
                            <input type="text" name="num_of_hard" class="form-control" 
                            placeholder="# of meduim [Max {{App\Question::where('difficulty', 'hard')->get()->count()}}] (currently {{$quiz->num_of_hard}})" aria-describedby="basic-addon2">
                        </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                        {!! Form::submit('Edit Quiz!',
                            array('class' => 'btn btn-primary')
                        ) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>


        
        
        
        
        
        
        
        
        
@endsection
