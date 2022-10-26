@extends('layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="text-center mb-3">
                <h2 class="text-primary">Your Request Information</h2>
            </div>
            <div class="row">
                <div class="col-md-8 mx-auto mt-5">
                    <form action="{{ route('easy-return.update',$easyReturn->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div>
                            <p><span class="fw-bold">Request ID :</span> <span>{{ $easyReturn->id }}</span></p>
                            <p><span class="fw-bold">Store :</span> <span>{{ $easyReturn->store->name }}</span></p>
                            <p><span class="fw-bold">Store Type : </span><span>{{ ucwords($easyReturn->store->store->type) }}</span>
                            </p>
                            <p><span class="fw-bold">Price : </span><span>{{ $easyReturn->price }}</span></p>
                            <p><span class="fw-bold">Description : </span>
                                <span>{{ $easyReturn->description }}</span>
                            </p>
                            <p><span class="fw-bold">Status : </span><span>{{ ucwords($easyReturn->status) }}</span></p>
                            <p><span class="fw-bold">Requested at :
                                </span><span>{{ $easyReturn->created_at->format('Y-m-d : H-i') }}
                                    ({{ $easyReturn->created_at->diffForHumans() }})</span></p>
                            <p><span class="fw-bold">Comment : </span>
                                <textarea name="comment" id="" cols="80" rows="2">{{ $easyReturn->comment }}</textarea>
                            </p>
                            <p><span class="fw-bold">Images : </span></p>
                            @foreach ($easyReturn->getMedia('return') as $image)
                                <img class="p-2 rounded-pill" src="{{ asset($image->getUrl()) }}" alt="" height="200px"
                                    width="200px">
                            @endforeach

                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
