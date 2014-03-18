<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Authentication App With Laravel 4</title>
        {{ HTML::style('//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css') }}
    </head>

    <body>

        <nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container">
                <ul class="nav navbar-nav">
                    @if(!Auth::check())
                        <li>{{ HTML::link('users/register', 'Register') }}</li>
                        <li>{{ HTML::link('login', 'Login') }}</li>
                    @else
                        <li>{{ HTML::link('users/edit', 'Edit') }}</li>
                        <li>{{ HTML::link('logout', 'Logout') }}</li>
                        <li>{{ HTML::link('users/delete', 'Delete') }}</li>
                    @endif
                </ul>
            </div>
        </nav>


        <div class="container">

            @if(Session::has('message'))
                <p class="alert alert-{{ Session::get('message-type') }}">{{ Session::get('message') }}</p>
            @endif

            {{ $content }}

        </div>

    </body>
</html>