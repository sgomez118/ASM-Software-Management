@extends('layouts.home')

@section('content')
    <div class="container">
        <div class="content">
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
            <style>
                #clockdiv{
                    font-family: sans-serif;
                    color: #fff;
                    display: inline-block;
                    font-weight: 100;
                    text-align: center;
                    font-size: 30px;
                }

                #clockdiv > div{
                    padding: 10px;
                    border-radius: 3px;
                    background: #00BF96;
                    display: inline-block;
                }

                #clockdiv div > span{
                    padding: 15px;
                    border-radius: 3px;
                    background: #00816A;
                    display: inline-block;
                }

                .smalltext{
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
                var deadline = new Date(timeUp*1000);
                console.log(deadline);
                initializeClock('clockdiv', deadline);
            </script>
            @include('scorecard._question')
            @section('question')
            @show
        </div>
    </div>
@endsection