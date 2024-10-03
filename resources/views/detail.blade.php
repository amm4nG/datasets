@extends('layouts.app')
@section('content')
    <main id="main">
        <div class="container p-3" style="margin-top: 9rem">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-5 fs-2" style="color: #38527E"><a style="color: #38527E" href="{{ url('datasets') }}">
                            <i class="bi bi-arrow-left-short fs-3 "></i></a>Detail Dataset</p>
                    <div class="card p-5">
                        <div class="row align-items-center" style="margin-top:-27px">
                            <div class="col-md-1" id="img-dataset">
                                <i class="fad fa-database fa-4x" style="color: #38527E"></i>
                            </div>
                            <div class="col-md-11 mb-2">
                                <a href="{{ url('detail') }}">
                                    <h2 class="mt-3 text-capitalize" style="color: #38527E">{{ $dataset->name }}</h2>
                                </a>
                                <p><span class="">Creator by {{ $dataset->full_name }}</span></p>

                            </div>
                            <div class="col-md-12">
                                <a href="{{ url('download/' . $id) }}" class="btn btn-sm mb-3 text-white p-2 ps-3 pe-3"
                                    style="background-color: #38527E"><i class="bi bi-download me-1"></i> Download</a>
                                <p>{{ $dataset->abstract }}</p>
                            </div>
                            <div class="col-md-3">
                                <h4>Characteristics</h4>
                                <p>
                                    @foreach ($characteristics as $characteristic)
                                        {{ $characteristic->name_characteristic }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3">
                                <h4>Subject Area</h4>
                                <p>
                                    {{ $dataset->name_subject_area }}
                                </p>
                            </div>
                            <div class="col-md-3">
                                <h4>Associated Tasks</h4>
                                <p>
                                    @foreach ($associatedTasks as $associatedTask)
                                        {{ $associatedTask->name_associated_task }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3">
                                <h4>Feature Type</h4>
                                <p>
                                    @foreach ($featureTypes as $featureType)
                                        {{ $featureType->name_feature_type }}
                                    @endforeach
                                </p>
                            </div>
                            <div class="col-md-3">
                                <h4># Instances</h4>
                                <p>{{ $dataset->instances }}</p>
                            </div>
                            <div class="col-md-3">
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
                            <p class="fs-2" style="color: #38527E">Dataset Information</p>
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
                            <p class="fs-2" style="color: #38527E">Related Papers</p>
                        </div>
                        <div class="card-body">
                            @foreach ($papers as $paper)
                                <p class="fs-5"><a target="_blank" href="{{ url('' . $paper->url) }}"
                                        style="color: #38527E">{{ $paper->title }}</a></p>
                                <p style="margin-top: -17px">{{ $paper->description }}</p>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row mt-3">
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
            </div> --}}
        </div>
    </main>
@endsection
@section('scripts')
    <script></script>
@endsection
