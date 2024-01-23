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
        <div class="container login-container" style="margin-top: 7rem; margin-bottom: 3rem">
            <div class="text-center">
                <h1 class="fw-bold" style="color: #38527E">Dataset Donation Form</h1>
                <h5 style="color: gray">We offer users the option to upload their dataset data to our repository.</h5>
                <h5 style="color: gray">Users can provide tabular or non-tabular dataset data which will be made publicly
                    available on our
                    repository. Donators are free to edit their donated datasets, but edits must be approved before
                    finalizing.</h5>
            </div>

            <div class="row justify-content-center mt-5">
                <div class="col-md-8">
                    <h6 class="card-title fs-2 text-start" style="color: #38527E; margin-bottom: 1rem;">Basic
                        Info</h6>
                    <div class="card p-4 rounded-3">
                        <div class="card-body ">
                            <form>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Dataset Namee </label>
                                    <input type="email" class="form-control" id="email" placeholder="">
                                </div>

                                <!-- Button ditempatkan di luar tag div dengan class mb-3 -->
                            </form>
                            <button type="submit" class="btn w-100 mt-4" style="background-color: #38527E">
                                <h5 class="text-light mt-2">Submit</h5>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection

<!-- ======= Header ======= -->
