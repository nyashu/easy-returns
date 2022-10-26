@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        @if (auth()->user()->role_id == 1)
            <div class="row mt-5">
                <div class="col-xl-12 mb-5 mb-xl-3">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Latest Store Registrations </h3>

                                </div>
                                <div class="col text-right">
                                    <a href="#!" class="btn btn-sm btn-primary">See all</a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Store</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($stores as $store)
                                        <tr>
                                            <th scope="row">{{ $store->name }}</th>
                                            <th>{{ $store->email }}</th>
                                            <th>
                                                @if ($store->store->type == 'furnitures')
                                                    {{ 'Furniture' }}
                                                @elseif($store->store->type == 'electronics')
                                                    {{ 'Electronics' }}
                                                @elseif ($store->store->type == 'fashions')
                                                    {{ 'Fashion' }}
                                                @endif
                                            </th>
                                            <th scope="col">
                                                <span class="badge badge-dot mr-4">
                                                    <i class="bg-{{ $store->is_verified ? 'success' : 'danger' }}"></i>
                                                    <span
                                                        class="status">{{ $store->is_verified ? 'Verified' : 'Not Verified' }}</span>
                                                </span>
                                            </th>
                                            <th>
                                                <div class="d-flex justify-content-between">
                                                    <form action="{{ route('store-verify', [$store->id]) }}" method="POST">
                                                        @csrf
                                                        @if ($store->is_verified)
                                                            <button class="btn btn-sm btn-danger" type="submit"
                                                                name="status" value="0">Unverify</button>
                                                        @else
                                                            <button class="btn btn-sm btn-success" type="submit"
                                                                name="status" value="1">Verify</button>
                                                        @endif
                                                    </form>
                                                </div>
                                            </th>
                                        </tr>
                                    @empty
                                        <span>No stores found</span>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        {{ $stores->links() }}
                    </div>
                </div>
                {{-- <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Social traffic</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Referral</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        1,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        5,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">70%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Google
                                    </th>
                                    <td>
                                        4,807
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Instagram
                                    </th>
                                    <td>
                                        3,678
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        twitter
                                    </th>
                                    <td>
                                        2,645
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">30%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            </div>
        @endif

        @if (auth()->user()->role_id == 2)
            <div class="row mt-5">
                <div class="col-xl-12 mb-5 mb-xl-3">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h3 class="mb-0">Latest Return Requests </h3>

                                </div>
                                <div class="col text-right">
                                    <a href="#!" class="btn btn-sm btn-primary">See all</a>
                                </div>
                            </div>
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
                                                    <i class="fa-solid cursor fa-pen-to-square"></i>
                                                    <i class="fa-sharp fa-solid cursor fa-trash text-danger"
                                                        data-toggle="modal" data-target="#deleteReturnModal"
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
                                                                            @if ($return->status == 'pending')
                                                                                <span
                                                                                    class="text-warning">{{ ucwords($return->status) }}</span>
                                                                            @elseif ($return->status == 'rejected')
                                                                                <span
                                                                                    class="text-danger">{{ ucwords($return->status) }}</span>
                                                                            @elseif ($return->status == 'in progress')
                                                                                <span
                                                                                    class="text-primary">{{ ucwords($return->status) }}</span>
                                                                            @elseif ($return->status == 'verified')
                                                                                <span
                                                                                    class="text-success">{{ ucwords($return->status) }}</span>
                                                                            @endif
                                                                        </h3>
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
                    </div>
                </div>
                {{-- <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="mb-0">Social traffic</h3>
                            </div>
                            <div class="col text-right">
                                <a href="#!" class="btn btn-sm btn-primary">See all</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Referral</th>
                                    <th scope="col">Visitors</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        1,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">60%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-danger" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Facebook
                                    </th>
                                    <td>
                                        5,480
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">70%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Google
                                    </th>
                                    <td>
                                        4,807
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">80%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-primary" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        Instagram
                                    </th>
                                    <td>
                                        3,678
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">75%</span>
                                            <div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        twitter
                                    </th>
                                    <td>
                                        2,645
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <span class="mr-2">30%</span>
                                            <div>
                                                <div class="progress">
                                                <div class="progress-bar bg-gradient-warning" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 30%;"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> --}}
            </div>
        @endif
        <div class="row">
            <div class="col-xl-8 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">Sales value</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales"
                                        data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'
                                        data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3 active" data-toggle="tab">
                                            <span class="d-none d-md-block">Month</span>
                                            <span class="d-md-none">M</span>
                                        </a>
                                    </li>
                                    <li class="nav-item" data-toggle="chart" data-target="#chart-sales"
                                        data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}'
                                        data-prefix="$" data-suffix="k">
                                        <a href="#" class="nav-link py-2 px-3" data-toggle="tab">
                                            <span class="d-none d-md-block">Week</span>
                                            <span class="d-md-none">W</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <!-- Chart wrapper -->
                            <canvas id="chart-sales" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-muted ls-1 mb-1">Performance</h6>
                                <h2 class="mb-0">Total orders</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                        <div class="chart">
                            <canvas id="chart-orders" class="chart-canvas"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush
