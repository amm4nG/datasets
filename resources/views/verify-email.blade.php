@extends('layouts.app')
@section('content')
    <div class="container" style="margin-top: 10rem">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4">
                    We have sent a verification email to the email you registered.
                    <form action="{{ url('email/verification-notification') }}" method="post">
                        @csrf
                        <button type="submit" class="btn text-white mt-3" style="background-color: #38527E"><i class="far fa-link"></i> Resend link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
