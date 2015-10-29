<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
                <H1>The Questions</H1>
                <ol>
                <!-- 
                    Iterates through the questions passed by the routes. 
                    Prints the prompt, difficulty and all the answers. 

                    foreach - laravel special function for blade
                    /{/{/}/} - equivalent of php echo. 
                        Note: there are others that can be used.
                -->
                @foreach($questions as $question)
                    <li><H1>{{$question->prompt}}</H1></li>
                    <li><H2>{{$question->difficulty}}</H2></li>
                    @foreach($question->answers as $answer)
                    {{$answer->text}}<br>
                    @endforeach
                @endforeach
                </ol>
            </div>
        </div>
    </body>
</html>
