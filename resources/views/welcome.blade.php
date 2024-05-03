@extends('layouts.app')
@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">

        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1"
                    data-aos="fade-up" data-aos-delay="200">
                    <h1>Welcome</h1>
                    <h2>Dataset collection platform, where each contribution positively impacts research and innovation
                        advancement.</h2>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ url('datasets') }}" class="btn-get-started scrollto"><i class="fal fa-database"></i> View Datasets</a>
                        <a href="{{ url('donation') }}" class="btn-get-started scrollto ms-3"><i class="fal fa-database"></i> Contribute a Dataset</a>
                    </div>

                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">
        <div class="container mt-4">
            <div class="row">
                @if ($newDataset == false)
                @else
                    @if ($popularDataset != null)
                        <div class="col-md-6 mb-3">
                            <div class="card p-4 rounded-top-4 shadow-sm">
                                <p class="fw-bold fs-3 text-center" style="color: #38527E"><i class="fad fa-database"></i> Popular Datasets</p>
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
                            <p class="fw-bold fs-3 text-center" style="color: #38527E"><i class="fad fa-database"></i> New Datasets</p>
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
        </div>
    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
@endsection
