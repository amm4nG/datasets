@extends('layouts.app')
@section('content')
    <header id="header" class="fixed-top " style="background-color: #38527E">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ url('/') }}">Datasets</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto active" href="{{ url('datasets') }}">Datasets</a></li>
                    <li class="dropdown"><a href="#"><span>Contribute dataset</span> <i
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
                    @auth
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
                    @endauth
                    </li>
                    @guest
                        <a href="{{ url('login') }}" class="text-center">Login</a>
                    @endguest
                    </li>
                </ul>

                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
            <!-- Modal -->


        </div>
    </header><!-- End Header -->

    <main id="main">
        <div class="container" style="margin-top: 7rem">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: #38527E">Browse Datasets</h3>

                    {{-- <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" style="background-color: #38527E" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-filter-left"
                                style="color: #FFD000"></i>
                            SORT BY # VIEWS, DESC
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div> --}}

                    <div class="row mt-4">
                        @foreach ($datasets as $dataset)
                            <div class="col-md-12 mb-2 shadow-sm">
                                <div class="card p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-1" id="img-dataset">
                                            <img class="img-fluid" src="{{ asset('assets/img/clients/client-6.png') }}"
                                                alt="">
                                        </div>
                                        <div class="col-md-11 mb-2">
                                            <a href="{{ url('detail/dataset/' . $dataset->id) }}">
                                                <h5 class="text-capitalize" style="color: #38527E">{{ $dataset->name }}</h5>
                                            </a>
                                            <p>{{ $dataset->abstract }}
                                            </p>
                                            <div class="input-group gap-5">
                                                <a href="" class="nav-link"><i
                                                        class="bi bi-search me-2"></i>Clasification</a>
                                                <a href="" class="nav-link"><i
                                                        class="bi bi-journal-text me-2"></i>Tabular</a>
                                                <a href="" class="nav-link"><i class="bi bi-building me-2"></i>{{ $dataset->instances }}
                                                    Instances</a>
                                                <a href="" class="nav-link"><i class="bi bi-table me-2"></i>{{ $dataset->features }}
                                                    Features</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Search DataSet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn text-white" style="background-color:  #38527E">Search</button>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection

<!-- ======= Header ======= -->
