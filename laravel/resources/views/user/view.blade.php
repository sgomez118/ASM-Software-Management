<html>
    <body>
        <div class="container">
            <div class="content">
                <H1>The Users</H1>
                <!-- 
                    Iterates through the questions passed by the routes. 
                    Prints the prompt, difficulty and all the answers. 

                    foreach - laravel special function for blade
                    /{/{/}/} - equivalent of php echo. 
                        Note: there are others that can be used.
                -->
                @foreach($users as $user)
                    Name: {{$user->name}} <br>
                    Email: {{$user->email}} <br>
                    Type: {{$user->type}} <br>
                    <br>
                @endforeach
            </div>
        </div>
    </body>
</html>




