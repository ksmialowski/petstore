<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content="Page about pets"/>
    <meta name="author" content="Kamil Śmiałowski"/>
    <title>PetStore</title>
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet"/>
</head>
<body>
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="{{ route('pets.index') }}">PetStore</a>
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <x-nav-link href="{{ route('pets.index', ['status' => 'available']) }}">Available</x-nav-link>
            <x-nav-link href="{{ route('pets.index', ['status' => 'pending']) }}">Pending</x-nav-link>
            <x-nav-link href="{{ route('pets.index', ['status' => 'sold']) }}">Sold</x-nav-link>
        </ul>
    </div>
</nav>
<!-- Section-->
@yield('content')
<!-- Footer-->
<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">
            Copyright &copy; Kamil Śmiałowski {{ now()->format('Y') }}
        </p>
    </div>
</footer>
</body>
</html>
