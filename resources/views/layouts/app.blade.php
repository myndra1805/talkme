<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <meta name="dicoding:email" content="ariyuhendra99@gmail.com">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <v-app id="app" class="grey">
        <header>
            <navbar-app 
                user="{{Auth::user()}}"
                csrf='@csrf'
                route="{{ route('logout') }}"
                users="{{App\User::whereNotIn('id', [Auth::user()->id])->get()}}"
            ></navbar-app>
        </header>
        <v-main>
            @yield('content')
        </v-main>
        <!-- <footer>
            <footer-app></footer-app>
        </footer> -->
    </v-app>
</body>
</html>

<script>
    // window.addEventListener("DOMContentLoaded", event => {
    //     setInterval(() => {
    //         setLocation()
    //     }, 5000)
    // })
</script>