@extends('layouts.app')
@section('content')
    @if (optional($myDataset)->count() < 1)
        <main id="basic-info">
            <div class="container login-container p-3" style="margin-top: 10rem; margin-bottom: 3rem">
                <div class="text-center">
                    <h1 class="fw-bold mb-4" style="color: #38527E"><i class="fad fa-database"></i> Formulir Donasi Dataset </h1>
                    <h5 style="color: gray">Kami menawarkan kepada pengguna opsi untuk dataset mereka ke repositori kami.</h5>
                    <h5 style="color: gray">Pengguna dapat menyediakan data tabular atau non-tabular yang akan tersedia untuk umum di repositori kami. Para
                    donatur bebas mengedit dataset yang disumbangkan, tetapi pengeditan harus disetujui sebelum finalisasi.
                </div>
                <form>
                    <div class="row justify-content-center mt-5">
                        <div class="col-md-8">
                            <p class="card-title fs-2 mb-2 text-start" style="color: #38527E; ">Info Dasar</p>
                            <div class="card p-4 rounded-3">
                                <div class="card-body">
                                    <div class="mb-3 position-relative">
                                        <label for="" class="form-label">Nama Dataset <sup class="text-danger">*</sup></label>
                                        <input type="text" class="form-control" id="name" placeholder="">
                                        <div class="invalid-feedback">
                                        </div>
                                        <hr class="border-bottom">
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="" class="form-label"><span class="fw-bold">Abstract</span> (Gars besar mengenai dataset) <sup class="text-danger">*</sup></label>
                                        <textarea name="" id="abstract" cols="30" class="form-control" rows="5"></textarea>
                                        <div class="invalid-feedback">
                                        </div>
                                        {{-- <p style="color: gray">Maximum 1000 Characters.</p> --}}
                                        <hr class="border-bottom">
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="" class="form-label">Jumlah Baris dalam
                                            Dataset <sup class="text-danger">*</sup></label>
                                        <input type="number" class="form-control" name="instances" id="instances"
                                            placeholder="">
                                        <div class="invalid-feedback">
                                        </div>
                                        <hr class="border-bottom">
                                    </div>
                                    <div class="mb-3 position-relative">
                                        <label for="" class="form-label">Jumlah Fitur dalam Dataset <sup class="text-danger">*</sup></label>
                                        <input type="number" class="form-control" id="features" placeholder="">
                                        <hr class="border-bottom">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <p class="card-title fs-2 text-start mb-2" style="color: #38527E;">Karakteristik Dataset</p>
                            <div class="card p-1 rounded-3">
                                <div class="card-body" id="characteristics">
                                    @foreach ($characteristics as $characteristic)
                                        <div class="form-check d-flex align-items-center">
                                            <label class="form-check-label"
                                                for="flexCheckDefault">{{ $characteristic->name_characteristic }}</label>
                                            <input class="form-check-input ms-auto characteristic" type="checkbox"
                                                value="{{ $characteristic->id }}" style="border-color: #38527E;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <p class="card-title fs-2 text-start mb-2" style="color: #38527E;">Bidang Studi</p>
                            <div class="card p-1 rounded-3">
                                <div class="card-body" id="subjectArea">
                                    @foreach ($subjectAreas as $subjectArea)
                                        <div class="form-check d-flex align-items-center">
                                            <label class="form-check-label"
                                                for="tabular">{{ $subjectArea->name_subject_area }}</label>
                                            <input class="form-check-input ms-auto subjectArea" type="radio"
                                                name="subjectArea" id="subjectArea" value="{{ $subjectArea->id }}"
                                                style="border-color: #38527E;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <p class="card-title fs-2 text-start mb-2" style="color: #38527E;">Tugas Terkait</p>
                            <div class="card p-1 rounded-3">
                                <div class="card-body" id="associatedTasks">
                                    @foreach ($associatedTasks as $associatedTask)
                                        <div class="form-check d-flex align-items-center">
                                            <label class="form-check-label"
                                                for="flexCheckDefault">{{ $associatedTask->name_associated_task }}</label>
                                            <input class="form-check-input ms-auto associatedTasks" type="checkbox"
                                                value="{{ $associatedTask->id }}" style="border-color: #38527E;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <p class="card-title fs-2 text-start mb-2" style="color: #38527E;">Jenis Fitur</p>
                            <div class="card p-1 rounded-3">
                                <div class="card-body" id="featureTypes">
                                    @foreach ($featureTypes as $featureType)
                                        <div class="form-check d-flex align-items-center">
                                            <label class="form-check-label"
                                                for="flexCheckDefault">{{ $featureType->name_feature_type }}</label>
                                            <input class="form-check-input ms-auto featureTypes" type="checkbox"
                                                value="{{ $featureType->id }}" style="border-color: #38527E;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-md-8">
                            <a href="#" id="btnNext" onclick="next()" class="btn fs-5 text-light mt-2"
                                style="background-color: #38527E; width: 6rem"><i class="fas fa-angle-double-right"></i>
                                Next
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </main>
        <main id="more-info" style="display: none">
            <div class="container" style="margin-top: 6rem; margin-bottom: 3rem">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <p class="card-title fs-2 mt-5 mb-1 text-start" style="color: #38527E;">
                            Deskripsi Dataset</p>
                        <textarea name="information" id="information" cols="30" class="form-control" rows="10"></textarea>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-8">
                        <p class="card-title fs-2 mb-1 text-start" style="color: #38527E;">File Dataset</p>
                        <div class="card p-4">
                            <input type="file" multiple class="form-control" name="" id="file">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-3">
                    <div class="col-md-8">
                        <p class="card-title fs-2 mb-1 text-start" style="color: #38527E;">Paper Yang Berhubungan</p>
                        <div class="card p-4">
                            <input type="text" placeholder="Judul paper" class="form-control mb-3" name="title"
                                id="title">
                            <textarea name="description" id="description" cols="30" class="form-control mb-3" rows="5"
                                placeholder="Deskripsi"></textarea>
                            <input type="url" class="form-control" placeholder="Link paper" name="urlPaper"
                                id="urlPaper">
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mt-4">
                    <div class="col-md-8">
                        <a href="#" class="btn btn-secondary fs-5" onclick="previous()" id="previous"><i class="fas fa-angle-double-left"></i> Sebelumnya</a>
                        <button id="submit" onclick="submit()" type="button" class="btn fs-5 text-light"
                            style="background-color: #38527E"><i class="fas fa-save"></i> Sumbang</button>
                    </div>
                </div>
            </div>
        </main>
        <main id="pending" style="display: none">
            <div class="container login-container p-3" style="margin-top: 10rem; margin-bottom: 3rem">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-4">
                            Dataset yang Anda upload sedang diproses, Anda dapat menyumbangkan dataset baru setelah dataset yang Anda upload
                            sebelumnya disetujui.
                            <p class="mt-2"><span class="badge bg-info">Status : pending</span></p>
                            <a href="{{ url('my/dataset') }}" class="btn text-white mt-3"
                                style="background-color: #38527E; max-width: 10rem;">Lihat Dataset Saya</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @else
        <main id="pending">
            <div class="container login-container p-3" style="margin-top: 10rem; margin-bottom: 3rem">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card p-4">
                            Dataset yang Anda upload sedang diproses, Anda dapat menyumbangkan dataset baru setelah dataset yang Anda upload
                            sebelumnya
                            telah disetujui.
                            <p class="mt-2"><span class="badge bg-info">Status : pending</span></p>
                            <a href="{{ url('my/dataset') }}" class="btn text-white mt-1"
                                style="background-color: #38527E; max-width: 12rem;">Lihat Dataset Saya</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    @endif
@endsection
@section('scripts')
    <script>
        let formData = new FormData()

        function next() {
            // Menghapus kelas 'is-invalid' dari semua elemen yang memiliki kelas tersebut
            document.querySelectorAll('.is-invalid').forEach(function(element) {
                element.classList.remove('is-invalid');
            });

            document.getElementById('btnNext').disabled = true

            let name = document.getElementById('name').value
            let abstract = document.getElementById('abstract').value
            let instances = document.getElementById('instances').value
            let features = document.getElementById('features').value

            formData.append('name', name)
            formData.append('abstract', abstract)
            formData.append('instances', instances)
            formData.append('features', features)

            let selectCharacteristic = document.querySelectorAll('.characteristic')
            let characteristics = []
            selectCharacteristic.forEach(checkbox => {
                if (checkbox.checked) {
                    characteristics.push(checkbox.value)
                }
            });
            formData.append('characteristics', characteristics)

            let subjectArea = document.querySelector('.subjectArea:checked')
            if (subjectArea) {
                subjectArea = subjectArea.value
            } else {
                subjectArea = ""
            }
            formData.append('subjectArea', subjectArea)

            let selectAssociatedTasks = document.querySelectorAll('.associatedTasks')
            let associatedTasks = []
            selectAssociatedTasks.forEach(checkbox => {
                if (checkbox.checked) {
                    associatedTasks.push(checkbox.value)
                }
            });
            formData.append('associatedTasks', associatedTasks)

            let selectFeatureTypes = document.querySelectorAll('.featureTypes')
            let featureTypes = []
            selectFeatureTypes.forEach(checkbox => {
                if (checkbox.checked) {
                    featureTypes.push(checkbox.value)
                }
            });
            formData.append('featureTypes', featureTypes)

            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            fetch('/more/info', {
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
                        document.getElementById('btnNext').disabled = false
                        // Swal.fire({
                        //     icon: "error",
                        //     title: "Oops...",
                        //     text: data.message,
                        // });
                        const errorKey = data.key;

                        // Membuat ID dari kunci yang gagal validasi
                        const errorElementId = `${errorKey}`;

                        // Mengarahkan ke elemen dengan ID yang sesuai
                        const errorElement = document.getElementById(errorElementId);

                        // Lakukan sesuatu dengan elemen yang bermasalah, misalnya menyoroti input
                        if (errorElement) {
                            // Menyoroti elemen yang bermasalah
                            // errorElement.classList.add('error-highlight');
                            errorElement.classList.add('is-invalid');
                            // Mengarahkan halaman ke atas (animasi smooth)
                            window.scrollTo({
                                top: errorElement.getBoundingClientRect().top + window.scrollY - 170,
                                behavior: 'smooth'
                            });
                        }

                        // Mengambil elemen dengan class "invalid-feedback"
                        const invalidFeedback = document.querySelector('.invalid-feedback');

                        // Memeriksa apakah elemen ditemukan
                        if (invalidFeedback) {
                            // Mengubah isi (teks) dari elemen
                            invalidFeedback.textContent =
                                data.message;
                        }
                    } else {
                        document.getElementById('basic-info').style.display = "none"
                        document.getElementById('more-info').style.display = "block"
                    }
                })
                .catch(error => {
                    document.getElementById('btnNext').disabled = false
                    console.error('Ada kesalahan:', error);
                });
        }

        function previous(){
            document.getElementById('basic-info').style.display = "block"
            document.getElementById('more-info').style.display = "none"
            document.getElementById('btnNext').disabled = false
        }

        function submit() {
            document.getElementById('submit').disabled = true
            let information = document.getElementById('information').value
            if (information != "" || information != null || information != undefined) {
                formData.append('information', information)
            }

            let input = document.getElementById('file')
            let files = input.files
            Array.from(files).forEach(file => {
                formData.append('files[]', file)
            });

            let title = document.getElementById('title').value
            formData.append('title', title)

            let description = document.getElementById('description').value
            formData.append('description', description)

            let urlPaper = document.getElementById('urlPaper').value
            formData.append('urlPaper', urlPaper)

            console.log(urlPaper);

            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            fetch('/donation/store', {
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
                    if (data.status == 422 || data.status == 500) {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: data.message,
                        });
                        document.getElementById('submit').disabled = false
                    } else {
                        Swal.fire({
                            title: "Good job!",
                            text: "Your dataset is being processed!",
                            icon: "success"
                        });
                        document.getElementById('basic-info').style.display = "none"
                        document.getElementById('more-info').style.display = "none"
                        document.getElementById('pending').style.display = "block"
                    }
                })
                .catch(error => {
                    console.error('Ada kesalahan:', error);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "There is an error",
                    });
                    document.getElementById('submit').disabled = false
                });
        }
    </script>
@endsection
