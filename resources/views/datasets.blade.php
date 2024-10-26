@extends('layouts.app')
@section('content')
    <main id="main">
        <div class="container p-3" style="margin-top: 9rem">
            <div class="row">
                <div class="col-md-12">
                    <p class="fs-2" style="color: #38527E"><i class="fad fa-search"></i> Temukan Dataset</p>
                    <div class="row mt-4">

                        <div class="col-md-6">
                            <input type="text" class="form-control p-3 rounded-4" autocomplete="off" id="searching"
                                placeholder="Cari">
                            <div class="dropdown mt-2">
                                <div class="dropdown-menu p-2" id="search-results">
                                    @foreach ($datasets as $dataset)
                                        <a href="#" class="dropdown-item">{{ $dataset->name }}</a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 mt-1 text-center">
                            <select data-size="5" class="selectpicker show-tick form-select-lg mt-2 form-control"
                                data-live-search="true" title="Filter" id="filter">
                                <option value="all" selected>Tampilkan semua</option>
                                @foreach ($subjectAreas as $subjectArea)
                                    <option value="{{ $subjectArea->id }}">{{ $subjectArea->name_subject_area }}</option>
                                @endforeach
                            </select>
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
                                                    Jumlah baris</a>
                                                <a href="#" class="nav-link"><i
                                                        class="bi bi-table me-2"></i>{{ $dataset->features }}
                                                    Jumlah fitur</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-md-4">
                                <p>Dataset tidak tersedia,
                                    <span>
                                        <a href="{{ url('donation') }}" style="color: #38527E"> Sumbang Dataset
                                        </a>
                                    </span>
                                </p>
                                <p class="text-center mt-4">
                                    <i class="fal fa-file-search fa-5x" style="color: #38527E"></i>
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main><!-- End #main -->

@endsection
@section('scripts')
    <script>
        let searchResults = document.getElementById('search-results');
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
                            <a href="#" class="dropdown-item disabled">Hasil pencarian :</a>
                            `
                        if (data.length > 0) {
                            data.forEach(element => {
                                searchResults.innerHTML +=
                                    `
                                    <a href="detail/dataset/${element.id}" class="dropdown-item">${element.name}</a>
                                    `
                            });
                        } else {
                            searchResults.innerHTML = ""
                            searchResults.innerHTML +=
                                `
                            <a href="#" class="dropdown-item disabled">Data tidak ditemukan</a>
                            `
                        }
                    } else {
                        searchResults.classList.remove('show');
                    }
                })
                .catch(error => {
                    console.error('Ada kesalahan:', error.message);
                });
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
    <script>
        let filter = document.getElementById('filter')
        filter.addEventListener('change', function() {
            fetch('filter/' + filter.value)
                .then(response => response.json())
                .then(data => {
                    let datasets = document.getElementById('datasets')
                    datasets.innerHTML = ''
                    if (data.datasets.length > 0) {
                        data.datasets.forEach(element => {
                            let count = 0
                            data.countDownloads.forEach(countDownload => {
                                if (countDownload == element.id) {
                                    count++
                                }
                            });
                            datasets.innerHTML += `
                                <div class="col-md-12 mb-2 mb-3">
                                    <div class="card p-4">
                                        <div class="row align-items-center">
                                            <div class="col-md-1" id="img-dataset">
                                                <i class="fad fa-database fa-4x" style="color: #38527E"></i>
                                            </div>
                                            <div class="col-md-11 mb-2">
                                                <a href="detail/dataset/${element.id}">
                                                    <h5 class="text-capitalize" style="color: #38527E">${element.name}
                                                    </h5>
                                                </a>
                                                <p>${element.abstract.length > 100 ? element.abstract.substring(0, 100) + '...' : element.abstract}
                                                </p>
                                                <div class="input-group gap-5">
                                                    <a href="" class="nav-link"><i class="bi bi-download me-2"></i>
                                                        ${count}
                                                    </a>
                                                    <a href="#" class="nav-link"><i class="bi bi-building me-2"></i>${element.instances}
                                                        Jumlah baris</a>
                                                    <a href="#" class="nav-link"><i class="bi bi-table me-2"></i>${element.features}
                                                        Jumlah fitur</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        });
                    } else {
                        datasets.innerHTML = `
                            <div class="col-md-4">
                                <p>Dataset tidak tersedia,
                                    <span>
                                        <a href="{{ url('donation') }}" style="color: #38527E"> Sumbang Dataset
                                        </a>
                                    </span>
                                </p>
                                <p class="text-center mt-4">
                                    <i class="fal fa-file-search fa-5x" style="color: #38527E"></i>
                                </p>
                            </div>
                        `
                    }
                })
                .catch(error => console.error('Error:', error));
        })
    </script>
@endsection
