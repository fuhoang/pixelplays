<!DOCTYPE html>
<html>
    <head>
        <title>Pixel Plays</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>


        <link rel="stylesheet" type="text/css" href="{{ asset('/css/style.css') }}">

        <!-- Angular JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.2/angular-route.min.js"></script>

        <script src="{{ asset('/app/packages/dirPagination.js') }}"></script>
        <script src="{{ asset('/app/app.js') }}"></script>
        <script src="{{ asset('/app/config/config.js') }}"></script>
        <script src="{{ asset('/app/services/services.js') }}"></script>

        <!-- App Controller -->
        <script src="{{ asset('/app/controllers/VideoController.js') }}"></script>
        <script src="{{ asset('/app/controllers/CategoryController.js') }}"></script>


    </head>
    <body ng-app="main-app">
        @include('partials.nav')

        @if (Auth::guest())
            @yield('content')
        @else
            <div class="container">
                <ng-view></ng-view>
            </div>
        @endif
    </body>
</html>
