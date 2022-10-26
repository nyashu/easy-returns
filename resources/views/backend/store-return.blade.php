@extends('layouts.app')

@section('content')
    <div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
        <div class="container-fluid">
            {{-- <div class="alert alert-danger" role="alert">
            <strong>This is a PRO feature!</strong>
        </div> --}}
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Traffic</h5>
                                        <span class="h2 font-weight-bold mb-0">350,897</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-chart-bar"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">New users</h5>
                                        <span class="h2 font-weight-bold mb-0">2,356</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                            <i class="fas fa-chart-pie"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 3.48%</span>
                                    <span class="text-nowrap">Since last week</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Sales</h5>
                                        <span class="h2 font-weight-bold mb-0">924</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-warning mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                                    <span class="text-nowrap">Since yesterday</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Performance</h5>
                                        <span class="h2 font-weight-bold mb-0">49,65%</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                            <i class="fas fa-percent"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-muted text-sm">
                                    <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                                    <span class="text-nowrap">Since last month</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Return Requests</h3>
                            </div>
                            {{-- <div class="col-4 text-right">
                                <a href="{{ route('stores.create') }}" class="btn btn-sm btn-primary">Add store</a>
                            </div> --}}
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Request ID</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Email</th>
                                    {{-- <th scope="col">Store type</th> --}}
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($returns as $return)
                                    <tr>
                                        <th>{{ $return->id }}</th>
                                        <th>{{ $return->user->email }}</th>
                                        {{-- <th>
                                            @if ($return->store->store->type == 'furnitures')
                                                {{ 'Furniture' }}
                                            @elseif($return->store->store->type == 'electronics')
                                                {{ 'Electronics' }}
                                            @elseif ($return->store->store->type == 'fashions')
                                                {{ 'Fashion' }}
                                            @endif
                                        </th> --}}
                                        <th>
                                            {{ $return->user->name }}
                                        </th>
                                        <th scope="col">
                                            @if ($return->status == 'pending')
                                                <span class="text-warning">{{ ucwords($return->status) }}</span>
                                            @elseif ($return->status == 'rejected')
                                                <span class="text-danger">{{ ucwords($return->status) }}</span>
                                            @elseif ($return->status == 'in progress')
                                                <span class="text-primary">{{ ucwords($return->status) }}</span>
                                            @elseif ($return->status == 'verified')
                                                <span class="text-success">{{ ucwords($return->status) }}</span>
                                            @endif
                                        </th>
                                        <th>
                                            <div class="d-flex justify-content-between">
                                                <i class="fa-solid cursor fa-eye text-primary" data-toggle="modal"
                                                    data-target="#showReturnModal-{{ $return->id }}"></i>
                                                <a href="{{ route('store-request-edit', ['id' => $return->id]) }}"><i
                                                        class="fa-solid cursor fa-pen-to-square"></i></a>
                                                <i class="fa-sharp fa-solid cursor fa-trash text-danger" data-toggle="modal"
                                                    data-target="#deleteReturnModal1"
                                                    data-return-id="{{ $return->id }}"></i>
                                            </div>

                                            <!--Show Modal -->
                                            @foreach ($returns as $return)
                                                <div class="modal fade" id="showReturnModal-{{ $return->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="exampleModalLabel">Return
                                                                    Request
                                                                    Information</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div>
                                                                    <h3><span class="text-primary">ID : </span>
                                                                        {{ $return->id }}</h3>
                                                                    <h3><span class="text-primary">Store : </span>
                                                                        {{ $return->store->name }}</h3>
                                                                    <h3><span class="text-primary">Store Type : </span>
                                                                        {{ $return->store->store->type }}</h3>
                                                                    <h3><span class="text-primary">User : </span>
                                                                        {{ $return->user->name }}</h3>
                                                                    <h3><span class="text-primary">Description : </span>
                                                                        {{ Str::limit($return->description, 20, '...') }}
                                                                    </h3>
                                                                    <h3><span class="text-primary">Status : </span>
                                                                        {{ $return->status }}
                                                                    </h3>
                                                                    <h3><span class="text-primary">Price : </span>
                                                                        {{ $return->price }}</h3>
                                                                    <h3><span class="text-primary">Created at : </span>
                                                                        {{ $return->created_at->diffForHumans() }}</h3>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </th>
                                    </tr>
                                @empty
                                    <th> No return request found </th>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $returns->links() }}
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">

                        </nav>
                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="row align-items-center justify-content-xl-between">
                <div class="col-xl-6">
                    <div class="copyright text-center text-xl-left text-muted">
                        © 2020 <a href="https://www.creative-tim.com" class="font-weight-bold ml-1"
                            target="_blank">Creative
                            Tim</a> &amp;
                        <a href="https://www.updivision.com" class="font-weight-bold ml-1" target="_blank">Updivision</a>
                    </div>
                </div>
                <div class="col-xl-6">
                    <ul class="nav nav-footer justify-content-center justify-content-xl-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative
                                Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.updivision.com" class="nav-link" target="_blank">Updivision</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About
                                Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md"
                                class="nav-link" target="_blank">MIT License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>

    <!--Delete Modal -->
    <div class="modal fade" id="deleteReturnModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="deleteReturnForm1">
                    @csrf()
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Choose
                            Action</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        You are trying to remove the request. Are you sure ?
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
        $('#deleteReturnModal1').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#deleteReturnForm1').attr('action', '/store/return-request/' + button.data('return-id'));
        });
    </script>
@endpush
