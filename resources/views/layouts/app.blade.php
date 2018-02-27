<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'WeCare') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div>
        @include('inc.navbar')
        <main id="app" class="py-4">
            @include('inc.messages')
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        // $(document).ready(function(){
        //     switch (location.pathname)
        //     {
        //         case "/":
        //             $("li").first().addClass("active");
        //             break;
        //         case "/about":
        //             $("li").first().next().addClass("active");
        //             break;
        //         case "/services":
        //             $("li").first().next().next().addClass("active");
        //             break;
        //         case "/posts":
        //             $("li").first().next().next().next().addClass("active");
        //             break;
        //         case "/posts/create":
        //             $("li").first().next().next().next().next().addClass("active");
        //             break;
        //         case "/login":
        //             $("li:contains('Login')").addClass('active');
        //             break;
        //         case "/register":
        //             $("li:contains('Register')").addClass('active');
        //             break;
        //         default:
        //             $("li").first().next().next().next().addClass("active");
        //             break;
        //     }
        // });
        $(".alert").delay(4000).slideUp(200, function() {
            $(this).alert('close');
        });
    </script>
</body>
</html>
