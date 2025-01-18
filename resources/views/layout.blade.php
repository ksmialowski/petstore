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
        <ul class="nav navbar-nav navbar-right">
            <x-nav-link href="{{ route('pets.create') }}">Add a pet</x-nav-link>
        </ul>
    </div>
</nav>

<!-- Toasts-->
<div class="toast-container top-0 end-0 p-3">
    @foreach(['success', 'danger'] as $alert_code)
        @if(session()->has($alert_code))
            @foreach(session()->get($alert_code, []) as $message)
                <div class="toast text-bg-{{ $alert_code }}" role="alert" data-bs-delay="3000">
                    <div class="toast-body">
                        <div class="d-flex gap-4">
                            <span><i class="fa-solid fa-check-circle fa-lg"></i></span>
                            <div class="d-flex flex-grow-1 align-items-center">
                                <span class="fw-semibold">{{ $message }}</span>
                            </div>
                            <button type="button" class="btn-close ms-auto me-2" data-bs-dismiss="toast"
                                    aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    @endforeach
</div>

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
<script src="{{ asset('js/bootstrap.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toastElement = document.querySelector('.toast');
        const toast = new bootstrap.Toast(toastElement);

        toast.show();
    });
</script>
</body>
</html>
