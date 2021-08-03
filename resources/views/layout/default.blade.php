<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Laravel') - Laravel 入门教程</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="{{mix('js/app.js')}}"></script>
    <script src="{{ URL::asset('/js/userlike.js') }}"></script>
    <script src="{{ URL::asset('/js/comment.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

@include('layout._header')

<div class="container">
    <div class="offset-md-1 col-md-10">
    @include('shared._message')
    @yield('content')

    @include('layout._footer')

    </div>
</div>
</body>
</html>
