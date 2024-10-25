@extends('layouts.app')
@section('content')
    <main id="main">
        <div class="container p-3" style="margin-top: 7rem">
            <div class="row">
                <div class="col-md-12">
                    <p class="fs-2 mt-3 mb-4" style="color: #38527E"><a style="color: #38527E" href="{{ url('my/dataset') }}"><i
                                class="bi bi-arrow-left-short fs-3 "></i></a>Detail Dataset Saya</p>
                    @if ($dataset->status == 'invalid')
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Dataset invalid!</strong> Please re-register your dataset.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card p-3">
                        <div class="row align-items-center">
                            <div class="col-md-1" id="img-dataset">
                                <i class="fad fa-database fa-4x ms-3" style="color: #38527E"></i>
                            </div>
                            <div class="col-md-11 mb-2">
                                <a href="{{ url('detail') }}">
                                    <h2 class="mt-3 text-capitalize" style="color: #38527E">{{ $dataset->name }}</h2>
                                </a>
                                <p><span class="badge bg-info p-1 me-2">{{ $dataset->status }}</span></span><span
                                        class="text-danger">{{ $dataset->note }}</span></p>

                            </div>
                            <div class="col-md-12 ms-3">
                                <p>{{ $dataset->abstract }}</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Karakteristik</h4>
                                <p>
                                    @if ($characteristics->count() > 0)
                                        @foreach ($characteristics as $characteristic)
                                            {{ $characteristic->name_characteristic }} @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Bidang Studi</h4>
                                <p>
                                    {{ $dataset->name_subject_area ?? '-' }}
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Tugas Terkait</h4>
                                <p>
                                    @if ($associatedTasks->count() > 0)
                                        @foreach ($associatedTasks as $associatedTask)
                                            {{ $associatedTask->name_associated_task }} @if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4>Jenis Fitur</h4>
                                <p>
                                    @if ($featureTypes->count() > 0)
                                        @foreach ($featureTypes as $featureType)
                                            {{ $featureType->name_feature_type }}
                                        @endforeach
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Jumlah Baris</h4>
                                <p>{{ $dataset->instances }}</p>
                            </div>
                            <div class="col-md-3 ms-3">
                                <h4># Jumlah Fitur</h4>
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
                            <p class="fs-2" style="color: #38527E">Informasi Dataset</p>
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
                            <p class="fs-2" style="color: #38527E">Paper Yang Berhubungan</p>
                        </div>
                        <div class="card-body">
                            @forelse ($papers as $paper)
                                <p class="fs-5"><a target="_blank" href="{{ url('' . $paper->url) }}"
                                        style="color: #38527E">{{ $paper->title }}</a>
                                </p>
                                <p style="margin-top: -17px">{{ $paper->description ?? '-' }}</p>
                                @empty
                                - Tidak ada paper
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
@section('scripts')
@endsection
