@extends('layout')

@section('content')
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-12">
                    <form method="POST" action="{{ route('pets.store') }}">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input
                                        type="text"
                                        id="petName"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name"
                                        value="{{ old('name') }}"
                                        placeholder="Name"
                                    />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <label class="form-label" for="petName">Name</label>
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-outline">
                                    <select
                                        id="petStatus"
                                        class="form-control @error('status') is-invalid @enderror"
                                        name="status"
                                    >
                                        <option value="" disabled {{ old('status') ? '' : 'selected' }}>Choose a
                                            status
                                        </option>
                                        <option value="available" {{ old('status') === 'available' ? 'selected' : '' }}>
                                            Available
                                        </option>
                                        <option value="pending" {{ old('status') === 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>
                                        <option value="sold" {{ old('status') === 'sold' ? 'selected' : '' }}>Sold
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <label class="form-label" for="petStatus">Status</label>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center mb-4">
                            <div class="mb-3">
                                <input
                                    class="form-control @error('photo') is-invalid @enderror"
                                    type="file"
                                    id="petFile"
                                    name="photo"
                                >
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label for="petFile" class="form-label">Photo</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-4">Save</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
