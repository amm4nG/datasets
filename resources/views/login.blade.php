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
                    <li>
                        <a class="text-center active">Login</a>
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
                            <form action="{{ url('login/validation') }}" method="post">
                                @csrf
                                <h4 class="fs-2" style="color: #38527E">Sign In</h4>
                                <h5>Don't have an account? <a href="{{ url('register') }}">Sign Up</a></h5>
                                @error('message')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                                <div class="mb-3">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="text" value="{{ old('email') }}" name="email"
                                        class="form-control @error('email')
                                        is-invalid                                        
                                    @enderror"
                                        id="email" placeholder="">
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password"
                                        class="form-control @error('password')
                                        is-invalid                                        
                                    @enderror"
                                        id="password" placeholder="">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <a href="{{ url('forgot/password') }}">Forgot Password?</a>
                                </div>
                                <button type="submit" class="btn  w-100" style="background-color: #38527E">
                                    <h5 class="text-light mt-2">Submit</h5>
                                </button>
                                <div class="divider "><span>Or Login with Provider</span></div>

                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-3 mb-2">
                                        <a href="{{ url('auth/google/redirect') }}">
                                            <div class="card p-2">
                                                <iconify-icon icon="flat-color-icons:google"
                                                    class="fs-2 ms-2"></iconify-icon>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="{{ url('auth/github/redirect') }}">
                                            <div class="card p-2">
                                                <iconify-icon icon="devicon:github" class="fs-2 ms-2"></iconify-icon>
                                            </div>
                                        </a>
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
