@extends('layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6">
                    <img class="card-img-top mb-5 mb-md-0"
                         style="max-width: 600px; max-height:700px;"
                         src="{{ $pet->photo ?: 'https://dummyimage.com/600x700/dee2e6/6c757d.jpg"' }}"
                         alt="{{ $pet->name }}"
                    />
                </div>
                <div class="col-md-6">
                    <div class="small mb-1">Status: {{ Str::ucfirst($pet->status) }}</div>
                    <h1 class="display-5 fw-bolder">{{ Str::ucfirst($pet->name) }}</h1>
                    <p class="lead">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi.
                        Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam
                        minima ea iste laborum vero?
                    </p>
                    <div class="d-flex">
                        <div>
                            <a href="{{ route('pets.edit', ['pet' => $pet->id]) }}" class="btn btn-outline-dark">
                                Edit
                            </a>
                        </div>
                        <div>
                            <button type="button" class="btn btn-outline-danger ms-2" data-bs-toggle="modal"
                                    data-bs-target="#deletePet">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="deletePet" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="deletePetLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="deletePetLabel">
                        Are you sure you want to delete this?
                    </h1>
                </div>
                <div class="modal-body">
                    <p>
                        You are about to permanently delete this data. This action cannot be undone. Do you wish to
                        continue?
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form method="POST" action="{{ route('pets.destroy', ['pet' => $pet->id]) }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
