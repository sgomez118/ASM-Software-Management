
{{-- View Courses --}}

<html>
    <body>
        <div class="container">
            <div class="content">
                <H1>The Courses</H1>
                <!-- 
                    Iterates through the questions passed by the routes. 
                    Prints the prompt, difficulty and all the answers. 

                    foreach - laravel special function for blade
                    /{/{/}/} - equivalent of php echo. 
                        Note: there are others that can be used.
                -->
                @foreach($courses as $course)
                    Name: {{$course->name}} <br>
                    Term: {{$course->term}} <br>
                    Lecturer ID: {{$course->lecturer_id}} <br>
                    <br>
                @endforeach
            </div>
        </div>
    </body>
</html>






