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
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card p-5 rounded-3">
                        <div class="card-body">
                            <form>
                                <h4 class="fs-2" style="color: #38527E">Sign Up</h4>
                                <h5>Already have an account? <a href="{{url('login')}}">Sign In</a></h5>
                                <div class="mb-3">
                                    <label for="Fullname" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" placeholder="">
                                </div>
                                <div class="mb-3">
                                    <label for="confirm password" class="form-label">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirm password" placeholder="">
                                </div>



                                <button type="submit" class="btn  w-40" style="background-color: #38527E">
                                    <h5 class="text-light mt-2">Submit</h5>
                                </button>
                                <div class="divider "><span>Or Login with Provider</span></div>

                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-3 ">

                                        <div class="card p-2">
                                            <iconify-icon icon="flat-color-icons:google" class="fs-2 ms-3"></iconify-icon>
                                        </div>

                                    </div>
                                    <div class="col-md-3 ">

                                        <div class="card p-2">
                                            <iconify-icon icon="devicon:github" class="fs-2 ms-3"></iconify-icon>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection

<!-- ======= Header ======= -->
