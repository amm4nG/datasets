@extends('layouts.admin')
@section('content')
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" style="background-color: #38527E" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3"> <sup>datasets</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/dashboard') }}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                menu
            </div>
            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Manage Datasets</span></a>
            </li>

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ url('admin/manage/users') }}">
                    <i class="fas fa-fw fa-users"></i>
                    <span>Manage Users</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->email }}</span>
                                <img class="img-profile rounded-circle" src="{{ asset('img/undraw_profile.svg') }}">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0" style="color: #38527E"><a href="{{ url('admin/manage/datasets') }}"
                                style="color: #38527E"><i class="fas fa-arrow-left mr-2"></i></a>Detail Dataset</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <div class="row align-items-center">
                                    <div class="col-md-1" id="img-dataset">
                                        <img class="img-fluid" src="{{ asset('assets/img/clients/client-6.png') }}"
                                            alt="">
                                    </div>
                                    <div class="col-md-11 mb-2">
                                        <a href="#" class="nav-link">
                                            <h2 class="mt-3 text-capitalize" style="color: #38527E">{{ $dataset->name }}
                                            </h2>
                                        </a>
                                        <p class="text-capitalize]" style="margin-bottom: 0px">{{ $dataset->full_name }}
                                        </p>
                                        <span id="status"
                                            class="badge bg-info p-1 me-2">{{ $dataset->status }}</span><span
                                            class="text-danger">{{ $dataset->note }}</span>
                                    </div>
                                    <div class="col-md-12 p-3">
                                        <p>{{ $dataset->abstract }}</p>
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
                    </div>

                    <!-- Content Row -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <div class="card p-4">
                                <h3 style="color: #38527E">Dataset Information</h3>
                                {!! $dataset->information !!}
                                @foreach ($data as $item)
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h3 style="color: #38527E">
                                                {{ $item['fileName'] }}
                                            </h3>
                                            <p style="margin-top: -7px">Data example</p>
                                            <div class="table-responsive">
                                                <table class="table table-sm table-striped">
                                                    @php
                                                        $records = $item['records'];
                                                    @endphp
                                                    @foreach ($records as $record)
                                                        <tr>
                                                            @foreach ($record as $r)
                                                                <td class="text-capitalize text-end">
                                                                    {{ $r }}
                                                                </td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="card p-4">
                                <h4>Papers</h4>
                                @foreach ($papers as $paper)
                                    <p class="fs-5"><i class="fas fa-book me-2" style="color: #38527E"></i><a
                                            style="text-decoration: none; color: #38527E" class="" target="_blank"
                                            href="{{ url('' . $paper->url) }}"
                                            style="color: #38527E">{{ $paper->title }}</a></p>
                                    <p style="margin-top: -17px">{{ $paper->description }}</p>
                                @endforeach
                            </div>
                        </div>
                        @if ($dataset->status == 'pending')
                            <div class="col-md-3" id="btnValidate">
                                <a href="#" onclick="valid({{ $id }})"
                                    class="btn btn-success btn-sm mt-2"><i class="fas fa-check mr-1"></i>Approve</a>
                                <button data-toggle="modal" data-target="#modalInvalid"
                                    class="btn btn-danger btn-sm mt-2"><i class="fas fa-times mr-1"></i>Reject</button>
                            </div>
                        @endif
                    </div>
                    <!-- Content Row -->
                    <div class="row">
                    </div>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalInvalid" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Note!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" placeholder="Enter notes" class="form-control" id="note">
                    <div style="display: none" id="noteRequired" class="invalid-feedback">
                        The note field is required.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" id="invalid" onclick="invalid({{ $id }})" class="btn text-white"
                        style="background-color: #38527E">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function valid(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, approve it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    fetch('/admin/validate/dataset/' + id, {
                            method: 'PUT',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            },
                            body: {
                                id: id
                            },
                        })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .then(data => {
                            document.getElementById('btnValidate').style.display = "none"
                            document.getElementById('status').innerHTML = "valid"
                            Swal.fire({
                                title: "Validated!",
                                text: "Success",
                                icon: "success"
                            });
                        })
                        .catch(error => {
                            console.error('Ada kesalahan:', error.message);
                        });
                }
            });
        }

        function invalid(id) {
            let formData = new FormData()
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            let note = document.getElementById('note').value
            document.getElementById('invalid').disabled = true
            formData.append('note', note)
            fetch('/admin/invalid/dataset/' + id, {
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
                    if (data.status == 422) {
                        document.getElementById('note').classList.add('is-invalid')
                        document.getElementById('noteRequired').style.display = "block"
                        document.getElementById('invalid').disabled = false
                    } else {
                        location.reload();
                        document.getElementById('modalInvalid').style.display = "none"
                    }
                    console.log(data);
                })
                .catch(error => {
                    console.error('Ada kesalahan:', error.message);
                });
        }
    </script>
@endsection
