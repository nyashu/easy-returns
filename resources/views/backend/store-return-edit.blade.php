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
                                <h3 class="mb-0">Edit Return Request</h3>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-12">
                </div> --}}
                    @if (Session::has('success'))
                        <div class="alert alert-success text-center mx-3" role="alert">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    <form role="form" method="POST" action="{{ route('store-request-edit', ['id' => $request->id]) }}" class="mx-3">
                        @method('PUT')
                        @csrf

                        <div class="row">
                            <div class="col-md-8 mx-auto mt-5">
                                <div>
                                    <p><span class="text-info font-weight-bold">Request ID :</span> <span>{{ $request->id }}</span></p>
                                    <p><span class="text-info font-weight-bold">User Name :</span> <span>{{ $request->user->name }}</span></p>
                                    <p><span class="text-info font-weight-bold">Description : </span><span>{{ $request->description }}</span></p>
                                    <p><span class="text-info font-weight-bold">Price : </span><span>{{ $request->price }}</span></p>
                                    <p><span class="text-info font-weight-bold">Status : </span> 
                                    <select class="form-control" name="status" id="">
                                        <option value="pending" {{ ($request->status == 'pending') ? 'selected' : '' }}>Pending</option>
                                        <option value="in progress" {{ ($request->status == 'in progress') ? 'selected' : '' }}>In progress</option>
                                        <option value="rejected" {{ ($request->status == 'rejected') ? 'selected' : '' }}>Rejected</option>
                                        <option value="verified" {{ ($request->status == 'verified') ? 'selected' : '' }}>Verified</option></select></p>
                                    <p><span class="text-info font-weight-bold">Requested at :
                                        </span><span>{{ $request->created_at->format('Y-m-d : H-i') }}
                                            ({{ $request->created_at->diffForHumans() }})</span></p>
                                            <span class="text-info font-weight-bold">Comment :
                                            </span><textarea name="comment" id="" cols="80" rows="2">{{ $request->comment }}</textarea>
                                    <p><span class="text-info font-weight-bold">Images : </span></p>
                                    @foreach ($request->getMedia('return') as $image)
                                        <img class="p-2 rounded-pill" src="{{ asset($image->getUrl()) }}" alt="" height="200px" width="200px">
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="text-center mb-2">
                            <button type="submit" class="btn btn-primary mt-4">{{ __('Update Request') }}</button>
                        </div>
                    </form>

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
@endsection
