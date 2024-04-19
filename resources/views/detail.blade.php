@extends('layouts.app')
@section('content')
    <header id="header" class="fixed-top " style="background-color: #38527E">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ url('/') }}">Datasets</a></h1>
            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Datasets</a></li>
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
                    <h3 class="fw-bold" style="color: #38527E"><a style="color: #38527E" href="{{ url('datasets') }}"><i
                                class="bi bi-arrow-left-short fs-3 "></i></a>Detail Dataset</h3>
                    <div class="card p-3">
                        <div class="row align-items-center">
                            <div class="col-md-1" id="img-dataset">
                                <img class="img-fluid" src="{{ asset('assets/img/clients/client-6.png') }}" alt="">
                            </div>
                            <div class="col-md-11 mb-2">
                                <a href="{{ url('detail') }}">
                                    <h2 class="mt-3 text-capitalize" style="color: #38527E">{{ $dataset->name }}</h2>
                                </a>
                                <p><span class="">Creator by {{ $dataset->full_name }}</span></p>

                            </div>
                            <div class="col-md-12 ms-3">
                                <a href="{{ url('download/' . $id) }}" class="btn btn-sm mb-2 text-white p-2"
                                    style="background-color: #38527E"><i class="bi bi-download me-1"></i> Download</a>
                                <p>{{ $dataset->abstract }}</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Dataset Characteristics</h4>
                                <p>
                                    @foreach ($characteristics as $characteristic)
                                        {{ $characteristic->name_characteristic }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Subject Area</h4>
                                <p>
                                    {{ $dataset->name_subject_area }}
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Associated Tasks</h4>
                                <p>
                                    @foreach ($associatedTasks as $associatedTask)
                                        {{ $associatedTask->name_associated_task }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Feature Type</h4>
                                <p>
                                    @foreach ($featureTypes as $featureType)
                                        {{ $featureType->name_feature_type }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Instances</h4>
                                <p>{{ $dataset->instances }}</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Features</h4>
                                <p>{{ $dataset->features }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h3 style="color: #38527E">Dataset Information</h3>
                        </div>
                        <div class="card-body">
                            {!! $dataset->information !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Papers</h4>
                        </div>
                        <div class="card-body">
                        @foreach ($papers as $paper)
                            <p class="fs-5"><i class="bi bi-journal me-2" style="color: #38527E"></i><a target="_blank"
                                    href="{{ url('' . $paper->url) }}" style="color: #38527E">{{ $paper->title }}</a></p>
                            <p style="margin-top: -17px">{{ $paper->description }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4>Reviews</h4>
                        </div>
                        <div class="card-body">
                        <div class="input-group gap-3 fs-2">
                            <p class="" style="color: #38527E">5</p>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </main>
@endsection
@section('scripts')
    <script></script>
@endsection
