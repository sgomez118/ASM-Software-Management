<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AQS Home</title>
        <!-- CSS And JavaScript -->
            <!-- Latest compiled and minified CSS -->
            <!-- <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" > -->

            <!-- Custom -->
            <link rel="stylesheet" href="bootstrap/css/app.css">
            <link rel="stylesheet" href="bootstrap/css/sb-admin.css">
            <link rel="stylesheet" href="bootstrap/css/timeline.css">
            <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
            
            <!-- Optional theme -->
            <link rel="stylesheet" href="bootstrap/css/carousel.css">
            <link rel="stylesheet" href="bootstrap/css/bootstrap.darkly.min.css">
             <!-- Latest compiled and minified JavaScript  -->
             <script src="bootstrap/js/jquery-1.11.3.min.js"></script>
             <script src="bootstrap/js/sb-admin-2.js"></script>
             <script src="bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="container">
            @include('layouts._nav')
        </div>
        <div>
           @section('content')
            <!-- <div class='mainContainer'> -->
            <div class='wrapper'>
                Content!

                @yield('content')
            </div>
            @show
        </div>
    </body>
</html>