<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link {{(request()->is('/')?'active':'')}}" href="{{route('home')}}">Dz7Laravel</a>
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
        </ul>
        </div>
    </nav>
    <div class='container-fluid'>
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>