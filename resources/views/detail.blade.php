@extends('layouts.app')
@section('content') 

    <main id="main">
        <div class="container" style="margin-top: 9rem">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="fw-bold mb-4" style="color: #38527E"><a style="color: #38527E" href="{{ url('datasets') }}">
                        <i class="far fa-angle-double-left fs-3 me-2"></i></a>Detail Dataset</h2>
                    <div class="card p-3">
                        <div class="row align-items-center">
                            <div class="col-md-1" id="img-dataset">
                                <i class="fad fa-database fa-4x" style="color: #38527E"></i>
                            </div>
                            <div class="col-md-11 mb-2">
                                <a href="{{ url('detail') }}">
                                    <h2 class="mt-3 text-capitalize" style="color: #38527E">{{ $dataset->name }}</h2>
                                </a>
                                <p><span class="">Creator by {{ $dataset->full_name }}</span></p>

                            </div>
                            <div class="col-md-12 ms-3">
                                <a href="{{ url('download/' . $id) }}" class="btn btn-sm mb-3 text-white p-2"
                                    style="background-color: #38527E"><i class="bi bi-download me-1"></i> Download</a>
                                <p>{{ $dataset->abstract }}</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Dataset Characteristics</h4>
                                <p>
                                    @foreach ($characteristics as $characteristic)
                                        {{ $characteristic->name_characteristic }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Subject Area</h4>
                                <p>
                                    {{ $dataset->name_subject_area }}
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Associated Tasks</h4>
                                <p>
                                    @foreach ($associatedTasks as $associatedTask)
                                        {{ $associatedTask->name_associated_task }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Feature Type</h4>
                                <p>
                                    @foreach ($featureTypes as $featureType)
                                        {{ $featureType->name_feature_type }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Instances</h4>
                                <p>{{ $dataset->instances }}</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Features</h4>
                                <p>{{ $dataset->features }}</p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h3 style="color: #38527E"><i class="far fa-info-circle"></i> Dataset Information</h3>
                        </div>
                        <div class="card-body">
                            {!! $dataset->information !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4 style="color: #38527E"><i class="fad fa-book-user"></i> Papers</h4>
                        </div>
                        <div class="card-body">
                        @foreach ($papers as $paper)
                            <p class="fs-5"><i class="fal fa-book-alt me-2"></i><a target="_blank"
                                    href="{{ url('' . $paper->url) }}" style="color: #38527E">{{ $paper->title }}</a></p>
                            <p style="margin-top: -17px">{{ $paper->description }}</p>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <div class="card p-4">
                        <div class="card-header">
                            <h4 style="color: #38527E"><i class="fal fa-star"></i> Reviews</h4>
                        </div>
                        <div class="card-body">
                        <div class="input-group gap-3 fs-2">
                            <p class="" style="color: #38527E">5</p>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </main>
@endsection
@section('scripts')
    <script></script>
@endsection
