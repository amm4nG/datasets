@extends('layouts.app')
@section('content') 

    <main id="main">
        <div class="container login-container" style="margin-top: 12rem; margin-bottom: 3rem">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card p-5 rounded-3">
                        <div class="card-body ">
                            <form id="test1">
                                <h4 class="fs-2" style="color: #38527E">Forgot Password</h4>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" autofocus placeholder="example@gmail.com" class="form-control"
                                        name="email" id="email">
                                    <div id="invalid-feedback" class="invalid-feedback">
                                    </div>
                                    <button type="button" id="btnSendCode" onclick="sendCodeVerification()"
                                        class="btn  w-100 mt-4" style="background-color: #38527E">
                                        <h5 class="text-light mt-2"><i class="fal fa-inbox-in"></i> Submit</h5>
                                    </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection
@section('scripts')
    <script>
        let email = "";

        function sendCodeVerification() {
            document.getElementById('btnSendCode').disabled = true
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            document.querySelectorAll('.is-invalid').forEach(function(element) {
                element.classList.remove('is-invalid');
            });


            email = document.getElementById('email').value;
            let formData = new FormData();
            formData.append('email', email);

            fetch('/send/code/verification', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status != 200) {
                        document.getElementById('email').classList.add('is-invalid');
                        document.getElementById('invalid-feedback').innerHTML = data.message;
                        document.getElementById('btnSendCode').disabled = false
                    } else {
                        document.getElementById('test1').innerHTML = `
                            <h4 class="fs-2" style="color: #38527E">Verification Code</h4>
                            <div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                                ${data.message}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                            <div class="mb-3">
                                <input type="text" autofocus class="form-control" name="code_verification" id="code_verification">
                                <div id="invalid-feedback" class="invalid-feedback">
                                </div>
                                <button id="btnVerify" type="button" onclick="verify()" class="btn w-100 mt-4"
                                    style="background-color: #38527E">
                                    <h5 class="text-light mt-2">Verify</h5>
                                </button>
                        `
                    }
                })
                .catch(error => {
                    document.getElementById('btnSendCode').disabled = false
                    console.log(error.message);
                });
        }

        function verify() {
            document.getElementById('btnVerify').disabled = true
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            let codeVerification = document.getElementById('code_verification').value
            let formData = new FormData();
            formData.append('email', email);
            formData.append('code_verification', codeVerification);

            fetch('/verify', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status != 200) {
                        document.getElementById('message').innerHTML = `
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `
                        document.getElementById('btnVerify').disabled = false
                    } else {
                        document.getElementById('test1').innerHTML = `
                        <h4 class="fs-2" style="color: #38527E">New Password</h4>
                        <div id="message" class="alert alert-warning alert-dismissible fade show" role="alert">
                            ${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <div class="mb-3">
                            <input type="password" autofocus class="form-control" name="password" id="password">
                            <div id="invalid-feedback" class="invalid-feedback">
                            </div>
                            <button id="btnResetPassword" type="button" onclick="resetPassword()" class="btn w-100 mt-4" style="background-color: #38527E">
                                <h5 class="text-light mt-2">Save</h5>
                            </button>
                        `
                    }
                })
                .catch(error => {
                    document.getElementById('btnVerify').disabled = false
                    console.error('Ada kesalahan:', error.message);
                });
        }

        function resetPassword() {
            document.getElementById('btnResetPassword').disabled = true
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            let newPassword = document.getElementById('password').value
            let formData = new FormData();
            formData.append('email', email);
            formData.append('password', newPassword);

            fetch('/reset/password', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.status != 200) {
                        document.getElementById('message').innerHTML = `
                        ${data.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        `
                        document.getElementById('btnResetPassword').disabled = false
                    } else {
                        window.location.replace('/')
                    }
                })
                .catch(error => {
                    document.getElementById('btnResetPassword').disabled = false
                    console.error('Ada kesalahan:', error.message);
                });
        }
    </script>
@endsection
