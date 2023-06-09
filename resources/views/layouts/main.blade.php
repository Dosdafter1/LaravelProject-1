<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @include('layouts.navigation')
    <!--
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link {{(request()->is('/')?'active':'')}}" href="{{route('home')}}">LaravelStore</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{(request()->is('/')?'active':'')}}" href="{{route('home')}}">Home</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{(request()->is('products')?'active':'')}}" href="{{route('products')}}">Products</a>
            </li>
            <li class="nav-item">
            <a class="nav-link {{(request()->is('countries')?'active':'')}}" href="{{route('countries')}}">Countries</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{(request()->is('category')?'active':'')}}" href="{{route('category')}}">Categories</a>
            </li>
        </ul>
        </div>
    </nav>
-->
    <div class='container-fluid'>
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>