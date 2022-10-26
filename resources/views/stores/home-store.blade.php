@extends('layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="text-center">
                <h2 class="text-primary">Stores</h2>
            </div>
            <div class="row gap-4 mt-3">
                @forelse ($stores as $store)
                    <div class="col-md-3 stores">
                        <div class="card h-100" style="width: 18rem;">
                            <img src="{{ $store->getFirstMediaUrl('profile') }}" class="card-img-top" alt="...">
                            <div class="card-body text-center">
                                <h5 class="card-title">{{ $store->name }}</h5>
                                <p class="card-text">{{ $store->address }}</p>
                                <p class="card-text">
                                    @if ($store->store->type == 'furnitures')
                                        {{ 'Furniture' }}
                                    @elseif ($store->store->type == 'electronics')
                                        {{ 'Electronic' }}
                                    @elseif ($store->store->type == 'fashions')
                                        {{ 'Fashion' }}
                                    @endif
                                </p>
                                <p class="card-text">Return Frequency : <span class="text-danger">{{ $store->return_frequency }}</span></p>
                                <a href="#" class="btn btn-primary">More Info</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center">
                        <h5 class="text-primary">No Stores Available</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
