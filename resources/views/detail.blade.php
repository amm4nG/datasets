@extends('layouts.app')
@section('content')
    <header id="header" class="fixed-top " style="background-color: #38527E">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html">Datasets</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Datasets</a></li>
                    <li class="dropdown"><a href="#"><span>Contribute dataset</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Donate New</a></li>
                            <li><a href="#">Link External</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span>About Us</span><i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
                            <li><a href="#">Contact Information</a></li>
                        </ul>
                    </li>
                    <li><a class="getstarted scrollto" href="#" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="bi bi-search me-2"></i>Search</a>
                    </li>
                    <li>
                        <a class="text-center">Login</a>
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
                <div class="col-md-12 mb-2">
                    <div class="card p-2 ">
                        <div class="row align-items-center">
                            <div class="col-md-1" id="img-dataset">
                                <img class="img-fluid" src="{{ asset('assets/img/clients/client-6.png') }}" alt="">
                            </div>
                            <div class="col-md-11 mb-2">
                                <a href="{{ url('detail') }}">
                                    <h2 class="mt-3" style="color: #38527E">Iris</h2>
                                </a>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                            </div>
                            <div class="col-md-12 ms-3">
                                <p>A small classic dataset from Fisher, 1936. One of the earliest known datasets used for
                                    evaluating classification methods.</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Dataset Characteristics</h4>
                                <p>Tabular</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Subject Area</h4>
                                <p>Biology
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Associated Tasks</h4>
                                <p>Classification</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Feature Type</h4>
                                <p>Real</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Instances</h4>
                                <p>150</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Features</h4>
                                <p>4</p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    
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
                        <button type="button" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection

<!-- ======= Header ======= -->
