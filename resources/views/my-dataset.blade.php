@extends('layouts.app')
@section('content')
    <main>
        <div class="container login-container p-3" style="margin-top: 8rem; margin-bottom: 3rem">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <p class="mb-4 fs-2" style="color: #38527E"><a style="color: #38527E" href="{{ url('donation') }}"><i
                                class="bi bi-arrow-left-short fs-3 "></i></a>Dataset Saya</p>
                    <div class="card p-4">
                        <div class="table-responsive">
                            <table id="my-datasets" class="text-center table table-bordered table-striped table-sm mt-3">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama Dataset</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Catatan</th>
                                        <th class="text-center">Aksi</th>
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
                                                <a href="{{ url('my/dataset/edit/' . $dataset->id) }}"
                                                    class="btn btn-sm btn-warning mb-1 @if ($dataset->status == 'pending') disabled @endif"><i
                                                        class="bi bi-pen text-white fw-bold"></i></a>
                                                <a href="{{ url('my/dataset/' . $dataset->id) }}"
                                                    class="btn btn-sm btn-primary mb-1"><i
                                                        class="bi bi-eye text-white fw-bold"></i></a>
                                                <a href="#" onclick="deleteDataset({{ $dataset->id }})"
                                                    class="btn btn-sm btn-danger mb-1"><i
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
                                const btn = `<a href="{{ url('my/dataset/edit/') }}/${dataset.id}" class="btn btn-sm btn-warning mb-1 ${dataset.status === 'pending' ? 'disabled' : ''}"><i class="bi bi-pen text-white fw-bold"></i></a>
                                <a href="{{ url('my/dataset/') }}/${dataset.id}" class="btn btn-sm btn-primary"><i
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
