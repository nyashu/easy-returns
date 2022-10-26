@extends('layouts.frontend')

@section('content')
    <section>
        <div class="container">
            <div class="text-center mb-3">
                <h2 class="text-primary">Your Requests</h2>
            </div>

            @if (Session::has('success'))
                <div class="alert alert-success text-center" role="alert">
                    {{ Session::get('success') }}
                </div>
            @endif

            <div class="m-2 text-center">
                <p class="text-decoration-underline">Total Requests as per Status</p>
                <span class="px-2 text-success">Verified Requests: {{ $verified }}</span>
                <span class="px-2 text-warning">Pending Requests: {{ $pending }}</span>
                <span class="px-2 text-primary">In Progress Requests: {{ $inprogress }}</span>
                <span class="px-2 text-info">Rejected Requests: {{ $rejected }}</span>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Request ID</th>
                        <th scope="col">Store</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($requests as $request)
                        <tr>
                            <th scope="row">{{ $request->id }}</th>
                            <td>{{ $request->store->name }}</td>
                            <td>{{ Str::limit($request->description, 10, '...') }}</td>
                            <td>{{ $request->price }}</td>
                            <td>
                                @if ($request->status == 'pending')
                                    <span class="badge bg-warning rounded-pill">{{ ucwords($request->status) }}</span>
                                @elseif ($request->status == 'rejected')
                                    <span class="badge bg-danger rounded-pill">{{ ucwords($request->status) }}</span>
                                @elseif ($request->status == 'in progress')
                                    <span class="badge bg-info rounded-pill">{{ ucwords($request->status) }}</span>
                                @elseif ($request->status == 'verified')
                                    <span class="badge bg-success rounded-pill">{{ ucwords($request->status) }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('easy-return.show', [$request->id]) }}"><i
                                            class="fa-solid cursor fa-eye text-primary"></i></a>
                                    <a href="{{ route('easy-return.edit',[$request->id]) }}"><i class="fa-solid cursor fa-pen-to-square text-primary"></i></a>
                                    <i class="fa-sharp fa-solid cursor fa-trash text-danger" data-toggle="modal"
                                        data-target="#deleteRequestModal" data-request-id="{{ $request->id }}"></i>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <th class="text-center" colspan="5">No request found</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        {{ $requests->links() }}
        </div>
    </section>
    <!--Delete Modal -->
    <div class="modal fade" id="deleteRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="deleteRequestForm">
                    @method('DELETE')
                    @csrf()
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose
                            Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        You are trying to remove the return request. Are you sure ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $('#deleteRequestModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#deleteRequestForm').attr('action', '/easy-return/' + button.data('request-id'));
        });
    </script>
@endpush
