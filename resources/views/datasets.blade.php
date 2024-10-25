@extends('layouts.app')
@section('content')
    <main id="main">
        <div class="container p-3" style="margin-top: 9rem">
            <div class="row">
                <div class="col-md-12">
                    <p class="fs-2" style="color: #38527E"><i class="fad fa-search"></i> Temukan Dataset</p>
                    <div class="row mt-4">
                        <div class="col-md-5">
                            <input type="text" class="form-control p-3 rounded-4" autocomplete="off" id="searching"
                                placeholder="Cari">
                            <div class="dropdown mt-2">
                                <div class="dropdown-menu p-0" id="search-results">
                                    @foreach ($datasets as $dataset)
                                        <a href="#" class="dropdown-item">{{ $dataset->name }}</a>
                                    @endforeach
                                    <!-- Hasil pencarian akan ditampilkan di sini -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4" id="datasets">
                        @forelse ($datasets as $dataset)
                            <div class="col-md-12 mb-2 mb-3">
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
                                            <p>{{ Str::limit($dataset->abstract, 100, '...') }}
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
                            <div class="col-md-4">
                                <p>The data is empty!,
                                    <span>
                                        <a href="{{ url('donation') }}" style="color: #38527E"> Contribute New
                                            Dataset
                                        </a>
                                    </span>
                                </p>
                                <p class="text-center mt-4">
                                    <i class="fal fa-file-search fa-5x" style="color: #38527E"></i>
                                </p>
                                {{-- <img src="{{ asset('assets/img/data-empty.png') }}" class="img-fluid" alt=""> --}}
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
        // let datasets = document.getElementById('datasets')
        let searchResults = document.getElementById('search-results');

        document.getElementById('searching').addEventListener('focus', function() {
            // datasets.classList.add('d-none')
            // searchResults.classList.add('show')
        })

        let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        let search = document.getElementById('searching')
        let formData = new FormData();
        search.addEventListener('input', function() {
            formData.append('name', search.value);
            fetch('/search/dataset/', {
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
                    searchResults.classList.add('show');
                    searchResults.innerHTML = ""
                    if (search.value.length > 0) {
                        searchResults.innerHTML +=
                            `
                            <a href="#" class="dropdown-item disabled">Your search results :</a>
                            `
                        if (data.length > 0) {
                            data.forEach(element => {
                                searchResults.innerHTML +=
                                    `
                                    <a href="#" class="dropdown-item">${element.name}</a>
                                    `
                            });
                        } else {
                            searchResults.innerHTML = ""
                            searchResults.innerHTML +=
                                `
                            <a href="#" class="dropdown-item disabled">Data not found</a>
                            `
                        }
                    }else{
                    searchResults.classList.remove('show');
                    }
                })
                .catch(error => {
                    console.error('Ada kesalahan:', error.message);
                });
        })
    </script>
@endsection
