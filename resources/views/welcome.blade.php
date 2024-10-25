@extends('layouts.app')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container p-3" sty>
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>Selamat Datang</h1>
                    <h2>Platform pengumpulan dataset, di mana setiap kontribusi Anda berdampak positif terhadap kemajuan penelitian dan
                    inovasi.</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ url('datasets') }}" class="btn-get-started scrollto"><i class="fal fa-database"></i> Lihat
                            Dataset</a>
                        <a href="{{ url('donation') }}" class="btn-get-started scrollto ms-3"><i
                                class="fal fa-database"></i> Donasi Dataset</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img mt-5" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>
    </section>
    <!-- End Hero -->

    <!-- start main -->
    <main id="main">
        {{-- <div class="container mt-4 p-3">
            <div class="row">
                @if ($newDataset == false)
                @else
                    @if ($popularDataset != null)
                        <div class="col-md-6 mb-3">
                            <div class="card p-4 rounded-top-4 shadow-sm">
                                <p class="fw-bold fs-3 text-center" style="color: #38527E"><i class="fad fa-database"></i>
                                    Popular Datasets</p>
                                <hr style="margin-top: -0px">
                                <div class="row align-items-center">
                                    <div class="col-md-2" id="img-dataset">
                                        <i class="fad fa-database fa-4x" style="color: #38527E"></i>
                                    </div>
                                    <div class="col-md-10 mb-2">
                                        <a href="{{ url('detail/dataset/' . optional($popularDataset)->id) }}">
                                            <h5 class="text-capitalize" style="color: #38527E">
                                                {{ optional($popularDataset)->name }}
                                            </h5>
                                        </a>
                                        <p>{{ Str::limit(optional($popularDataset)->abstract, 40, '...') }}
                                        </p>
                                        <div class="input-group gap-5">
                                            <a href="" class="nav-link"><i class="bi bi-download me-2"></i>
                                                @php
                                                    $count = 0;
                                                @endphp
                                                @foreach ($countDownloads as $countDownload)
                                                    @if ($countDownload == $popularDataset->id)
                                                        @php
                                                            $count++;
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                {{ $count }}
                                            </a>
                                            <a href="#" class="nav-link"><i
                                                    class="bi bi-building me-2"></i>{{ optional($popularDataset)->instances }}
                                                Instances</a>
                                            <a href="#" class="nav-link"><i
                                                    class="bi bi-table me-2"></i>{{ optional($popularDataset)->features }}
                                                Features</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="col-md-6">
                        <div class="card p-4 rounded-top-4 shadow-sm">
                            <p class="fw-bold fs-3 text-center" style="color: #38527E"><i class="fad fa-database"></i> New
                                Datasets</p>
                            <hr style="margin-top: -0px">
                            <div class="row align-items-center">
                                <div class="col-md-2" id="img-dataset">
                                    <i class="fad fa-database fa-4x" style="color: #38527E"></i>
                                </div>
                                <div class="col-md-10 mb-2">
                                    <a href="{{ url('detail/dataset/' . optional($dataset)->id) }}">
                                        <h5 class="text-capitalize" style="color: #38527E">{{ optional($dataset)->name }}
                                        </h5>
                                    </a>
                                    <p>{{ Str::limit(optional($dataset)->abstract, 40, '...') }}
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
                                                class="bi bi-building me-2"></i>{{ optional($dataset)->instances }}
                                            Instances</a>
                                        <a href="#" class="nav-link"><i
                                                class="bi bi-table me-2"></i>{{ optional($dataset)->features }}
                                            Features</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div> --}}

        <!-- start chart -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card p-3 shadow">
                        <div class="card-title">
                            <h2 class="text-center mt-2" style="color: #38527E">Statistik Jumlah Dataset</h2>
                        </div>
                        <div class="card-body">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div style="width: 50%; margin: auto;">
                <canvas id="myBarChart"></canvas>
            </div> --}}
        </div>
        <!-- end chart -->
    </main>
    <!-- End main -->
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Biology', 'Business', 'Computer  Science', 'Engineering', 'Games', 'Sosial Science'],
                datasets: [{
                    label: 'Jumlah Data',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
