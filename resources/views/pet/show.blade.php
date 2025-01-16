@extends('layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    @php
                        $photoUrl = Arr::last($pet['photoUrls']);
                        $isValidUrl = filter_var($photoUrl, FILTER_VALIDATE_URL);
                    @endphp

                    <img class="card-img-top mb-5 mb-md-0"
                         style="max-width: 600px; max-height:700px;"
                         src="{{ $isValidUrl ? $photoUrl : 'https://dummyimage.com/600x700/dee2e6/6c757d.jpg"' }}"
                         alt="{{ $pet['name'] }}"
                    />
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">Status: {{ Str::ucfirst($pet['status']) }}</div>
                    <h1 class="display-5 fw-bolder">{{ Str::ucfirst($pet['name']) }}</h1>
                    <p class="lead">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi.
                        Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam
                        minima ea iste laborum vero?
                    </p>
                    <div class="d-flex">
                        <a href="{{ route('pets.edit', ['pet' => $pet['id']]) }}"
                           class="btn btn-outline-dark flex-shrink-0"
                        >
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
