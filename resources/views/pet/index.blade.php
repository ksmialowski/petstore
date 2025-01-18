@extends('layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-5">
            <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
                @forelse($pets as $pet)
                    <div class="col mb-5">
                        <div class="card h-100">
                            <img class="card-img-top"
                                 style="max-width: 450px; max-height:300px;"
                                 src="{{ $pet->photo ?: 'https://dummyimage.com/450x300/dee2e6/6c757d.jpg' }}"
                                 alt="{{ $pet->name }}"
                            />
                            <div class="card-body p-4">
                                <div class="text-center">
                                    <h5 class="fw-bolder">{{ Str::ucfirst($pet->name) }}</h5>
                                    Status: {{ Str::ucfirst($pet->status) }}
                                </div>
                            </div>
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center">
                                    <a class="btn btn-outline-dark mt-auto" href="{{ route('pets.show', ['pet' => $pet->id]) }}">
                                        Show details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    Sorry, no pets found.
                @endforelse

                @if($pets->isNotEmpty())
                    <div class="d-flex justify-content-center">
                        {{ $pets->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
