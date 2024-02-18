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
                    <li class="dropdown"><a href="#" class="active"><span>Contribute dataset</span> <i
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
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->
        </div>
    </header><!-- End Header -->
    <main>
        <div class="container login-container" style="margin-top: 7rem; margin-bottom: 3rem">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <h1 class="fw-bold" style="color: #38527E"><a style="color: #38527E" href="{{ url('donation') }}"><i
                                class="bi bi-arrow-left-short fs-2 "></i></a>My Datasets</h1>
                    <div class="card p-4">
                        <div class="table-responsive">
                            <table id="my-datasets" class="text-center table table-bordered table-striped table-sm mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Name Dataset</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Note</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datasets as $dataset)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $dataset->name }}</td>
                                            <td><span class="badge bg-info p-1">{{ $dataset->status }}</span>
                                            </td>
                                            <td>
                                                @if ($dataset->note == null || $dataset->note == '')
                                                    -
                                                @else
                                                    {{ Str::limit($dataset->note, 20, '...') }}
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('my/dataset/' . $dataset->id) }}"
                                                    class="btn btn-sm btn-primary"><i
                                                        class="bi bi-eye text-white fw-bold"></i></a>
                                                <a href="#" onclick="deleteDataset({{ $dataset->id }})"
                                                    class="btn btn-sm btn-danger"><i
                                                        class="bi bi-trash text-white fw-bold"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#my-datasets').DataTable();
        });

        function deleteDataset(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
                    let formData = new FormData();
                    formData.append('name', 'Arman');

                    fetch('/delete/my/dataset/' + id, {
                            method: 'DELETE',
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
                            const table = $('#my-datasets').DataTable();
                            // Clear existing rows using DataTables API
                            table.rows().remove();
                            let no = 0;
                            data.datasets.forEach(dataset => {
                                no++
                                const status =
                                    `<span class="badge bg-info p-1">${dataset.status}</span>`
                                const btn = `<a href="{{ url('my/dataset/') }}/${dataset.id}" class="btn btn-sm btn-primary"><i
                                        class="bi bi-eye text-white fw-bold"></i></a>
                                <a href="#" onclick="deleteDataset(${dataset.id})" class="btn btn-sm btn-danger"><i
                                        class="bi bi-trash text-white fw-bold"></i></a>`;
                                table.row.add([no, dataset.name, status, dataset.note, btn]);
                            });
                            table.draw();
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your file has been deleted.",
                                icon: "success"
                            });
                        })
                        .catch(error => {
                            console.error('Ada kesalahan:', error.message);
                        });
                }
            });
        }
    </script>
@endsection
