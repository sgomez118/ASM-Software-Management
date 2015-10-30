<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AQS Home</title>
        <!-- CSS And JavaScript -->
            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >

            <!-- Optional theme -->
            <link rel="stylesheet" href="bootstrap/css/carousel.css">
            <link rel="stylesheet" href="bootstrap/css/bootstrap.darkly.min.css">
             <!-- Latest compiled and minified JavaScript  -->
             <script src="bootstrap/js/jquery-1.11.3.min.js"></script>
             <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            @include('layouts._nav')
        </div>
        <div>
           @section('content')
            <div class='mainContainer'>
                Content!
                @yield('content')
            </div>
        @show
        </div>
    </body>
</html>