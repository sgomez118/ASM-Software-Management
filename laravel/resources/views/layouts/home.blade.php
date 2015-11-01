<!DOCTYPE html>
<html lang="en">
    <head>
        <title>AQS Home</title>
        <!-- CSS  -->
            <!-- Custom -->
            <link rel="stylesheet" href="bootstrap/css/app.css">
            <link rel="stylesheet" href="bootstrap/css/sb-admin.css">
            <link rel="stylesheet" href="bootstrap/css/timeline.css">

            <!-- MetisMenu CSS -->
            <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
            
            <!-- theme -->
            <link rel="stylesheet" href="bootstrap/css/carousel.css">
            <link rel="stylesheet" href="bootstrap/css/bootstrap.darkly.min.css">
            
    </head>
    <body>
        <div class="container">
            @include('layouts._nav') 
            @section('navbar')  
            @endsection
        </div>

        <div>
            <div class='mainContainer'> 
               <!--  Content!-->
                @section('content')
                    @yield('content')
                @show
            </div>
        </div>

        <!--  JavaScript  -->
        <script src="bootstrap/js/jquery-1.11.3.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <!-- <script src="bootstrap/js/app.js"></script> -->
    </body>
</html>