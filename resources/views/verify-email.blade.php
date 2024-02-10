@extends('layouts.app')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card p-4">
                    We have sent a verification email to the email you registered.
                    <form action="{{ url('email/verification-notification') }}" method="post">
                        @csrf
                        <button type="submit" class="btn text-white mt-3" style="background-color: #38527E">resend link</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
