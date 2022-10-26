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
                                <h3 class="mb-0">Your Store Users</h3>
                            </div>
                            <div class="col-4 text-right">
                                
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    {{-- <th scope="col">Phone</th> --}}
                                    <th scope="col">Status</th>
                                    <th scope="col">Return Likeliness</th>
                                    <th scope="col">Total Return Count</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <th>{{ $user->name }}</th>
                                        <th>{{ $user->email }}</th>
                                        {{-- <th>{{ $user->phone }}</th> --}}
                                        <th>
                                            <span class="badge badge-dot mr-4">
                                                <i class="bg-{{ $user->is_verified ? 'success' : 'danger' }}"></i>
                                                <span
                                                    class="status">{{ $user->is_verified ? 'Verified' : 'Not Verified' }}</span>
                                            </span>
                                        </th>
                                        <th>
                                            @if (strtolower($user->user_return_likeliness) == 'low')
                                                <span class="text-danger">{{ $user->user_return_likeliness }}</span>
                                            @elseif(strtolower($user->user_return_likeliness) == 'moderate')
                                                <span class="text-primary">{{ $user->user_return_likeliness }}</span>
                                            @else
                                                <span class="text-success">{{ $user->user_return_likeliness }}</span>
                                            @endif
                                        </th>
                                        <th>{{ $user->returns_count }}</th>
                                        <th>
                                            <div class="d-flex justify-content-between">
                                                <i class="fa-solid cursor fa-eye text-primary" data-toggle="modal"
                                                    data-target="#showUserModal-{{ $user->id }}"></i>
                                                <i class="fa-solid cursor fa-pen-to-square"></i>
                                                <i class="fa-sharp fa-solid cursor fa-trash text-danger" data-toggle="modal"
                                                    data-target="#deleteUserModal" data-user-id="{{ $user->id }}"></i>
                                            </div>

                                            <!--Show Modal -->
                                            @foreach ($users as $user)
                                                <div class="modal fade" id="showUserModal-{{ $user->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header text-center">
                                                                <h5 class="modal-title" id="exampleModalLabel">User
                                                                    Information</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <div>
                                                                    <h3><span class="text-primary">Name : </span>
                                                                        {{ $user->name }}</h3>
                                                                    <h3><span class="text-primary">Address : </span>
                                                                        {{ Str::limit($user->address, 40, '...') }}</h3>
                                                                    <h3><span class="text-primary">Email : </span>
                                                                        {{ $user->email }}</h3>
                                                                    <h3><span class="text-primary">Phone : </span>
                                                                        {{ $user->phone }}</h3>
                                                                    <h3><span class="text-primary">Status : </span>
                                                                        {{ $user->is_verified ? 'Verified' : 'Not verified' }}
                                                                    </h3>
                                                                    <h3><span class="text-primary">Created at : </span>
                                                                        {{ $user->created_at->diffForHumans() }}</h3>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </th>
                                    </tr>
                                @empty
                                    <th> No users found </th>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $users->links() }}
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
    <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="POST" id="deleteUserForm">
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
                        You are trying to remove the user. Are you sure ?
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
        $('#deleteUserModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            $('#deleteUserForm').attr('action', '/backend/users/' + button.data('user-id'));
        });
    </script>
@endpush
