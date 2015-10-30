<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Laravel Quickstart - Basic</title>

        <!-- CSS And JavaScript -->
    </head>

    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <!-- Navbar Contents -->
            </nav>
        </div>
I'm doing a test
@foreach($questions as $question)
                    <li><H1>{{$question->prompt}}</H1></li>
                    <li><H2>{{$question->difficulty}}</H2></li>
                    @foreach($question->answers as $answer)
                    {{$answer->text}}<br>
                    @endforeach
                @endforeach
        @yield('content')
    </body>
</html>