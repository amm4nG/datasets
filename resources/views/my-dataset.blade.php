@extends('layouts.app')
@section('content')
    <header id="header" class="fixed-top " style="background-color: #38527E">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ url('/') }}">Datasets</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto" href="{{ url('datasets') }}">Datasets</a></li>
                    <li class="dropdown"><a href="#" class="active"><span>Contribute dataset</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ url('donation') }}">Donate New</a></li>
                            <li><a href="#">Link External</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>About Us</span><i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ url('about') }}">Who We Are</a></li>
                            <li><a href="{{ url('contact/information') }}">Contact Information</a></li>
                        </ul>
                    </li>
                    <li><a class="getstarted scrollto" href="#" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bi bi-search me-2"></i>Search</a>
                    </li>
                    <li class="dropdown"><a href="#"><span>{{ Auth::user()->email }}</span><i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            @if (Auth::user()->role == 'admin')
                                <li><a href="{{ url('admin/dashboard') }}">Dashboard Admin</a></li>
                            @else
                                <li><a href="#">Profile</a></li>
                            @endif
                            <li><a href="{{ url('logout') }}">Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->
    <main>
        <div class="container login-container" style="margin-top: 7rem; margin-bottom: 3rem">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="fw-bold" style="color: #38527E"><a style="color: #38527E" href="{{ url('donation') }}"><i
                                class="bi bi-arrow-left-short fs-2 "></i></a>My Datasets</h1>
                    <div class="card p-4">
                        <div class="table-responsive">
                            <table id="my-datasets" class="text-center table table-bordered table-striped table-sm mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Name Dataset</th>
                                        <th class="text-center">Abstract</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datasets as $dataset)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dataset->name }}</td>
                                            <td>{{ Str::limit($dataset->abstract, 23, '...') }}
                                            </td>
                                            <td><span
                                                    class="badge @if ($dataset->status == 'pending') bg-info @else bg-success @endif p-1">{{ $dataset->status }}</span>
                                            </td>
                                            <td><a href="" class="btn btn-sm btn-primary"><i
                                                        class="bi bi-eye text-white"></i></a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#my-datasets').DataTable();
        });
    </script>
@endsection
