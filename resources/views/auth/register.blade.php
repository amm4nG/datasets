@extends('layouts.app')
@section('content') 

    <main id="main">
        <div class="container login-container p-3" style="margin-top: 8rem; margin-bottom: 3rem">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card p-5 rounded-3">
                        <div class="card-body">
                            <form action="{{ url('register/user') }}" method="post">
                                @csrf
                                <h4 class="fs-2" style="color: #38527E">Daftar</h4>
                                <h5>Sudah punya akun? <a href="{{ url('login') }}">Masuk</a></h5>
                                <div class="mb-3">
                                    <label for="Fullname" class="form-label">Nama Lengkap</label>
                                    <input type="text" value="{{ old('full_name') }}"
                                        class="form-control @error('full_name') is-invalid                                        
                                    @enderror"
                                        id="fullname" name="full_name" placeholder="">
                                    @error('full_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" value="{{ old('email') }}" name="email"
                                        class="form-control @error('email') is-invalid                                        
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
                                        class="form-control @error('password') is-invalid                                        
                                    @enderror"
                                        id="password" placeholder="">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="confirm password" class="form-label">Konfirmasi Password</label>
                                    <input type="password" name="password_confirmation"
                                        class="form-control @error('password') is-invalid @enderror" id="confirm password"
                                        placeholder="">
                                </div>
                                <button type="submit" class="btn form-control" style="background-color: #38527E">
                                    <h5 class="text-light mt-2"><i class="far fa-user-plus"></i> Daftar</h5>
                                </button>
                                <div class="divider "><span>Atau daftar dengan</span></div>

                                <div class="row mt-3 justify-content-center">
                                    <div class="col-md-3 mb-2">
                                        <a href="{{ url('auth/google/redirect') }}">
                                            <div class="card p-2 d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="flat-color-icons:google"
                                                    class="fs-2"></iconify-icon>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-md-3 ">
                                        <a href="{{ url('auth/github/redirect') }}">
                                            <div class="card p-2 d-flex justify-content-center align-items-center">
                                                <iconify-icon icon="devicon:github" class="fs-2"></iconify-icon>
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
