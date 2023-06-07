<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>BookEditor</title>

    <link rel="stylesheet" href="{{url('css/main.css')}}">
    @yield('css')
</head>
<body>
    @include('includes/header')

    @yield('content')

    @include('includes/footer')
</body>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://ru.vuejs.org/js/vue.min.js"></script>

<script src="/js/main.js"></script>

@yield('js')
</html>
