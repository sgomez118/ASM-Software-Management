@extends('layouts.home')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a Quiz!</div>
                <div class="panel-body">
                    {!! Form::open(array('url' => 'save_quiz', 
                        'method' => 'post', 
                        'class' => 'form-horizontal', 
                        'role' => 'form'
                    )) !!}
                    <div class="form-group">
                        {!! Form::label('Title',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                            {!! Form::text('description', 
                            null, array('required', 
                            'class' => 'form-control'
                            )) !!}
                        </div>
                    </div>

                    <input type="hidden" name="course_id" id="myType">
                    <div class="form-group">
                        <label class="col-md-4 control-label">Choose Course</label>
                        <div class="dropdown col-md-6">
                            <input type="submit" value="Choose Course" class="btn btn-default selectpicker dropdown-toggle"  id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                {{-- Choose Type <span class="caret"></span> 
                            </input>--}}
                            <ul class="dropdown-menu inner selectpicker" role='menu' aria-labelledby="dropdownMenu1">
                                @if(Auth::check())
                                    @foreach(App\User::getCourses(Auth::user()->id) as $course)
                                        <li value={{$course->id}}><a href="#">{{$course->name}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                        
                       

                    <div class="form-group">
                        {!! Form::label('Time Limit',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class="col-md-6">
                            {!! Form::text('quizTime', 
                            null, array('required', 
                            'class' => 'form-control'
                            )) !!}
                        </div>
                    </div>

                     <div class="form-group">
                        {!! Form::label('Start Date',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                        <div class='col-md-6'>
                            <div class='input-group date' id='datetimepicker6' >
                                <input type='text' class="form-control" name='startDate' />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('End Date',
                        null, array(
                        'class' => 'col-md-4 control-label')
                        ) !!}
                         <div class='col-md-6'>
                            <div class='input-group date' id='datetimepicker7' >
                                <input type='text' class="form-control"name='endDate' />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                        {!! Form::submit('Save Quiz!',
                            array('class' => 'btn btn-primary')
                        ); !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


