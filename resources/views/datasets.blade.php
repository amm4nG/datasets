@extends('layouts.app')
@section('content') 
    <main id="main">
        <div class="container p-3" style="margin-top: 9rem">
            <div class="row">
                <div class="col-md-12">
                    <h3 style="color: #38527E"><i class="fad fa-search"></i> BROWSE DATAU</h3>
                    <div class="row mt-4">
                        @forelse ($datasets as $dataset)
                            <div class="col-md-12 mb-2 shadow-sm">
                                <div class="card p-4">
                                    <div class="row align-items-center">
                                        <div class="col-md-1" id="img-dataset">
                                            <i class="fad fa-database fa-4x" style="color: #38527E"></i>
                                        </div>
                                        <div class="col-md-11 mb-2">
                                            <a href="{{ url('detail/dataset/' . $dataset->id) }}">
                                                <h5 class="text-capitalize" style="color: #38527E">{{ $dataset->name }}
                                                </h5>
                                            </a>
                                            <p>{{ $dataset->abstract }}
                                            </p>
                                            <div class="input-group gap-5">
                                                <a href="" class="nav-link"><i class="bi bi-download me-2"></i>
                                                    @php
                                                        $count = 0;
                                                    @endphp
                                                    @foreach ($countDownloads as $countDownload)
                                                        @if ($countDownload == $dataset->id)
                                                            @php
                                                                $count++;
                                                            @endphp
                                                        @endif
                                                    @endforeach
                                                    {{ $count }}
                                                </a>
                                                <a href="#" class="nav-link"><i
                                                        class="bi bi-building me-2"></i>{{ $dataset->instances }}
                                                    Instances</a>
                                                <a href="#" class="nav-link"><i
                                                        class="bi bi-table me-2"></i>{{ $dataset->features }}
                                                    Features</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-3">
                                <p>The data is empty <span><a href="{{ url('donation') }}"> Contribute New
                                            Dataset</a></span></p>
                                <img src="{{ asset('assets/img/data-empty.png') }}" class="img-fluid" alt="">
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Search DataSet</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" placeholder="Search">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn text-white" style="background-color:  #38527E">Search</button>
                    </div>
                </div>
            </div>
        </div>

    </main><!-- End #main -->

@endsection
@section('scripts')
    <script>
        // Menggunakan event focus untuk menampilkan dropdown saat inputan mendapatkan fokus
        // document.getElementById('search').addEventListener('focus', function() {
        //     var resultDropdown = document.getElementById('resultDropdown');
            // Memunculkan dropdown
            // resultDropdown.innerHTML = "No Matching Data"

            // let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // let search = document.getElementById('search')
            // let formData = new FormData();
            // search.addEventListener('input', function() {
            //     formData.append('name', search.value);

            //     fetch('/search/dataset/', {
            //             method: 'POST',
            //             headers: {
            //                 'X-CSRF-TOKEN': csrfToken,
            //             },
            //             body: formData,
            //         })
            //         .then(response => {
            //             if (!response.ok) {
            //                 throw new Error(`HTTP error! Status: ${response.status}`);
            //             }
            //             return response.json();
            //         })
            //         .then(data => {
            //             resultDropdown.style.display = 'block';
            //             resultDropdown.innerHTML = ""
            //             console.log(data);
            //             data.forEach(element => {
            //                 resultDropdown.innerHTML +=
            //                     `<p onclick="detail(${element.id})" class="dropdown-item-text">${element.name}</p>`
            //             });
            //         })
            //         .catch(error => {
            //             console.error('Ada kesalahan:', error.message);
            //         });
            // })
        // });

        // Menggunakan event blur untuk menyembunyikan dropdown saat inputan kehilangan fokus
        // document.getElementById('search').addEventListener('blur', function() {
        //     var resultDropdown = document.getElementById('resultDropdown');

            // Menyembunyikan dropdown setelah jeda kecil untuk memberi waktu pengguna memilih
        //     setTimeout(function() {
        //         resultDropdown.style.display = 'none';
        //     }, 200);
        // });


    //     function detail(id) {
    //         window.location.href = "detail/dataset/" + id
    //     }
    // </script>
@endsection
