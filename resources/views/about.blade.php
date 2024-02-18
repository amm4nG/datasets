@extends('layouts.app')
@section('content')
    <header id="header" class="fixed-top " style="background-color: #38527E">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="{{ url('/') }}">Datasets</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar ">
                <ul>
                    <li><a class="nav-link" href="{{ url('datasets') }}">Datasets</a></li>
                    <li class="dropdown"><a href="#"><span>Contribute dataset</span> <i
                                class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="{{ url('donation') }}">Donate New</a></li>
                            <li><a href="#">Link External</a></li>
                        </ul>
                    </li>

                    <li class="dropdown"><a href="#"><span class="scrollto active">About Us</span><i
                                class="bi bi-chevron-down active"></i></a>
                        <ul>
                            <li><a href="#">Who We Are</a></li>
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
        <div class="container login-container" style="margin-top: 7rem; margin-bottom: 3rem">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="">
                        <h1 class="fw-bold " style="color: #38527E">About</h1>
                        <h5 class="text-start mt-5" style="color: gray;">
                            The UCI Machine Learning Repository is a collection of databases, domain theories, and data
                            generators that are used by the machine learning community for the empirical analysis of machine
                            learning algorithms.
                        </h5>
                        <h5 class="text-start mt-4" style="color: gray; ">
                            The archive was created as an ftp archive in 1987 by UCI PhD student David Aha. Since that time,
                            it has been widely used by students, educators, and researchers all over the world as a primary
                            source of machine learning datasets.
                        </h5>
                        <h5 class="mt-4" style="color: gray">Many people deserve thanks for making the repository a
                            success. Foremost among them are the
                            donors and creators of the databases and data generators. Special thanks should also go to the
                            past librarians of the repository: David Aha, Patrick Murphy, Christopher Merz, Eamonn Keogh,
                            Cathy Blake, Seth Hettich, David Newman, Arthur Asuncion, Moshe Lichman, Dheeru Dua, Casey
                            Graff. The current librarians are Kolby Nottingham, Rachel Longjohn, Markelle Kelly. The current
                            version of the web site was released in 2023. Funding support from the National Science
                            Foundation is gratefully acknowledged.</h5>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection

<!-- ======= Header ======= -->
