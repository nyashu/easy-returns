@extends('layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="text-center mb-3">
                <h2 class="text-primary">Your Request Information</h2>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto mt-5">
                    <div>
                        <p><span class="fw-bold">Request ID :</span> <span>{{ $request->id }}</span></p>
                        <p><span class="fw-bold">Store :</span> <span>{{ $request->store->name }}</span></p>
                        <p><span class="fw-bold">Store Type : </span><span>{{ ucwords($request->store->store->type) }}</span>
                        </p>
                        <p><span class="fw-bold">Price : </span><span>{{ $request->price }}</span></p>
                        <p><span class="fw-bold">Description : </span><span>{{ $request->description }}</span></p>
                        <p><span class="fw-bold">Status : </span><span>{{ ucwords($request->status) }}</span></p>
                        <p><span class="fw-bold">Requested at :
                            </span><span>{{ $request->created_at->format('Y-m-d : H-i') }}
                                ({{ $request->created_at->diffForHumans() }})</span></p>
                        <p><span class="fw-bold">Comment : </span><span>{{ $request->comment ?: '' }}</span></p>
                        <p><span class="fw-bold">Images : </span></p>
                        @foreach ($request->getMedia('return') as $image)
                            <img class="p-2 rounded-pill" src="{{ asset($image->getUrl()) }}" alt="" height="200px"
                                width="200px">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
