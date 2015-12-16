@extends('layouts.home')

@section('navbar')
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- <a class="navbar-brand active" href="#">AQS</a> -->
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    @if(Auth::check())
                        <li class="active"><a href="#">{{ Auth::user()->last_name}}, {{Auth::user()->first_name }}</a>
                        </li>
                    @endif
                    <li><a href="#" data-toggle="modal" data-target="#instructions">Instructions<span class="sr-only">(current)</span></a>
                    </li>
                    <li><a href="#"><span class="sr-only">(current)</span></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::check())
                        <div class="pull-right">
                            <li>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"
                                        style="
    margin-top: 7;
    margin-right: 7;
">End Test
                                </button>
                            </li>

                        </div>
                    @else
                        <li><a href="/login">Log in</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
@show

@section('content')
    <div class="container">
        <div class="content">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <div id="clockdiv">
                        <div>
                            <span class="days"></span>
                            <div class="smalltext">Days</div>
                        </div>
                        <div>
                            <span class="hours"></span>
                            <div class="smalltext">Hours</div>
                        </div>
                        <div>
                            <span class="minutes"></span>
                            <div class="smalltext">Minutes</div>
                        </div>
                        <div>
                            <span class="seconds"></span>
                            <div class="smalltext">Seconds</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="row">
                <br>
            </div>
            <style>
                #clockdiv {
                    font-family: sans-serif;
                    color: #fff;
                    display: inline-block;
                    font-weight: 100;
                    text-align: center;
                    font-size: 30px;
                }

                #clockdiv > div {
                    padding: 10px;
                    border-radius: 3px;
                    background: #00BF96;
                    display: inline-block;
                }

                #clockdiv div > span {
                    padding: 15px;
                    border-radius: 3px;
                    background: #00816A;
                    display: inline-block;
                }

                .smalltext {
                    padding-top: 5px;
                    font-size: 16px;
                }

                #clockdiv > div:first-child {
                    display: none;
                }
            </style>
            <script type="text/javascript">
                function getTimeRemaining(endtime) {
                    var t = Date.parse(endtime) - Date.now();
                    var seconds = Math.floor((t / 1000) % 60);
                    var minutes = Math.floor((t / 1000 / 60) % 60);
                    var hours = Math.floor((t / (1000 * 60 * 60)));
                    var days = Math.floor(t / (1000 * 60 * 60 * 24));
                    return {
                        'total': t,
                        'days': days,
                        'hours': hours,
                        'minutes': minutes,
                        'seconds': seconds
                    };
                }

                function initializeClock(id, endtime) {
                    var clock = document.getElementById(id);
                    var daysSpan = clock.querySelector('.days');
                    var hoursSpan = clock.querySelector('.hours');
                    var minutesSpan = clock.querySelector('.minutes');
                    var secondsSpan = clock.querySelector('.seconds');

                    function updateClock() {
                        var t = getTimeRemaining(endtime);

                        daysSpan.innerHTML = t.days;
                        hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
                        minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
                        secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

                        if (t.total <= 0) {
                            clearInterval(timeinterval);
                        }
                    }

                    updateClock();
                    var timeinterval = setInterval(updateClock, 1000);
                }

                // var quizTime = insert php time then do + quizTime
                var timeUp = {{$date->getTimestamp()}};
                console.log(timeUp);
                var deadline = new Date(timeUp * 1000);
                console.log(deadline);
                initializeClock('clockdiv', deadline);
            </script>
            @if($question->type == 'free-response')
            @include('scorecard.answer_free_response')
            @section('free-response')
            @else
            @include('scorecard._question')
            @section('question')
            @endif
            @show

                    <!-- Modal -->
            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Ending Exam</h4>
                        </div>
                        <div class="modal-body">
                            <p>You are about to end exam!<br>Are you sure you want to end?</p>
                        </div>
                        <div class="modal-footer">
                            {!! Form::open(array('action' => 'ScoreCardController@grade_quiz', 'method' => 'get', 'class' => 'form-inline')) !!}
                            <button type="submit" class="btn btn-success">Yes</button>
                            {!! Form::close() !!}
                            <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="instructions" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Instructions</h4>
                        </div>
                        <div class="modal-body">
                            <div class="panel-heading clearfix">
                                Please read the instructions below.
                            </div>
                            <div class="panel-body">

                                <ol>

                                    <li> One question per page will be displayed.</li>
                                    <li> Read the question carefully and follow any question prompt instructions</li>
                                    <li> For multiple choice questions, be aware that there may be more than one correct
                                        answer choice. Select ALL correct answer choices.
                                    </li>
                                    <li> For true/false questions, select either "true" or "false" but not both.</li>
                                    <li> For free response questions, fill in the text area under the prompt.</li>
                                    <li> Once you are done answering the question, hit the "next" button</li>
                                    <li> You can navigate between questions by hitting the "next" (to go to the next
                                        question) and "prev" (to go to a previous question) buttons
                                    </li>
                                    <li> Time will continue to count down as you navigate.</li>
                                    <li> The quiz will end either when you run out of time or when you reach the last
                                        question and hit "next."
                                    </li>
                                    <li> Your multiple choice and true/false questions will be automatically graded at
                                        the end of the quiz. Those results will be displayed on the screen
                                    </li>
                                    <li> Your responses to the free-response questions will be graded by a professor.
                                    </li>
                                    <li>When you are ready to take the quiz, click the "Agree &amp; Continue" button.
                                    </li>

                                </ol>

                                <div class="center-body"> GOOD LUCK!</div>

                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection