@extends('layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header text-center text-primary">{{ __('Choose store and return things ') }}</div>

                        <div class="card-body">

                            @if (Session::has('success'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <form method="POST" action="{{ route('easy-return.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="store"
                                        class="col-md-3 col-form-label text-md-end">{{ __('Store') }}</label>
                                    {{-- {{ dd() }} --}}
                                    <div class="col-md-8">
                                        <select name="store" id="store" class="form-control">
                                            <option value="" selected disabled>Choose Store</option>
                                            @if (isset($storeID))
                                                <option value="{{ $storeID->id }}" selected>{{ $storeID->name }}
                                                </option>
                                            @else
                                                @forelse ($stores as $store)
                                                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                                                @empty
                                                    <option value="">No Store Found</option>
                                                @endforelse
                                            @endif

                                        </select>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="desciption"
                                        class="col-md-3 col-form-label text-md-end">{{ __('Description') }}</label>

                                    <div class="col-md-8">
                                        <textarea id="description" rows="6" cols="50" class="form-control @error('description') is-invalid @enderror"
                                            name="description" value="{{ old('description') }}" required autocomplete="description" autofocus> </textarea>

                                        @error('description')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="price"
                                        class="col-md-3 col-form-label text-md-end">{{ __('Price') }}</label>

                                    <div class="col-md-8">
                                        <input type="number" name="price" id="price"
                                            class="form-control @error('price') is-invalid @enderror"value="{{ old('price') }}"
                                            required autocomplete="price" autofocus>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="file"
                                        class="col-md-3 col-form-label text-md-end">{{ __('Images') }}</label>

                                    <div class="col-md-8">
                                        <input id="file" type="file"
                                            class="form-control @error('file') is-invalid @enderror" name="file[]"
                                            value="{{ old('file') }}" required autocomplete="file" autofocus multiple>

                                        @error('file')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4 text-center">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Submit') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
