@extends('layouts.home')
@section('quiz_create')
 <div class="container-fluid">
    <div class="row"> 
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Quiz!</div>
                <div class="panel-body">
                @if(isset($quiz))
                    {!! Form::model($quiz, 
                        ['route' => ['quiz.update', $quiz->id], 
                        'method' => 'put', 'class' => 'form-horizontal'])
                    !!}
                @else
                    {!! Form::open(array('route' => array('quiz.store'), 'method' => 'post', 'class' => 'form-horizontal')) !!}
                @endif
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
                            <input type="submit" value="
                                    @if(isset($quiz))
                                    {{ App\Subject::find($quiz->subject_id)->name}}
                                    @else
                                    Subject
                                    @endif" class="btn btn-default selectpicker dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
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
                            placeholder="# of easy [Max {{App\Question::where('difficulty', 'easy')->get()->count()}}]" aria-describedby="basic-addon2">
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
                            placeholder="# of meduim [Max {{App\Question::where('difficulty', 'medium')->get()->count()}}]" aria-describedby="basic-addon2">
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
                                placeholder="# of meduim [Max {{App\Question::where('difficulty', 'hard')->get()->count()}}]" aria-describedby="basic-addon2">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                        {!! Form::submit('Save Quiz!',
                            array('class' => 'btn btn-primary')
                        ) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
           </div>
        </div>
     </div>
</div></div>
@show


