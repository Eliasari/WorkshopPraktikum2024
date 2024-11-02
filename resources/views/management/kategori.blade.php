@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a
                                href="{{ route('home') }}">Dashboard</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Menu Kategori</h6>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <div class="input-group">
                            <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" placeholder="Type here...">
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="d-flex justify-content-end mb-3 mt-3">
                <button type="button" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal"
                    data-bs-target="#createModal">
                    Add New Kategori
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Kategori List</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nomor Kategori</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama Kategori</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="kategoriTableBody">
                                        <!-- Data akan dimuat di sini oleh jQuery -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editKategoriForm">
                                <input type="hidden" id="edit_id_kategori">

                                <div class="form-group">
                                    <label for="edit_nama_kategori">Nama Kategori</label>
                                    <input type="text" class="form-control" id="edit_nama_kategori" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            {{-- modal add --}}
            <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Tambah Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createKategoriForm">
                                @csrf
                                <div class="form-group">
                                    <label for="nama">Nama Kategori</label>
                                    <input type="text" class="form-control" id="nama" name="nama" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                        id="closeModalButton">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                    {{-- <button type="button" class="btn btn-secondary" id="closeModalButton">Close</button> --}}
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            function loadKategoriData() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/kategori',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let kategoriData = response.data;
                            let tableBody = $('#kategoriTableBody');
                            tableBody.empty();

                            $.each(kategoriData, function(index, kategori) {
                                let row = `
                    <tr>
                        <td><p class="text-sm font-weight-bold mb-0">${kategori.id}</p></td>
                        <td><p class="text-sm font-weight-bold mb-0">${kategori.nama}</p></td>
                        <td>
                            <a href="#" class="editKategori" data-id="${kategori.id}" data-nama="${kategori.nama}"><i class="bi bi-pencil-square" style="color: #6c757d;"></i></a>
                            <a href="#" class="deleteKategori" data-id="${kategori.id}" data-toggle="tooltip" data-original-title="Delete Kategori"><i class="bi bi-trash" style="color: #6c757d;"></i></a>
                        </td>
                    </tr>`;
                                tableBody.append(row);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal mengambil data kategori.');
                    }
                });
            }

            loadKategoriData();

            $('#createKategoriForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/createKategori',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Kategori successfully added.');
                            $('#closeModalButton').click();
                            loadKategoriData(); 
                        } else {
                            alert('Failed to add kategori.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }

                });
            });

            // Fungsi untuk menghapus kategori
            $(document).on('click', '.deleteKategori', function(e) {
                e.preventDefault(); // Mencegah aksi default dari link
                let id_kategori = $(this).data('id');
                let confirmation = confirm('Apakah Anda yakin ingin menghapus kategori ini?');

                if (confirmation) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/kategori/' + id_kategori,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('Kategori successfully deleted.');
                                loadKategoriData(); // Pastikan ini adalah fungsi yang benar
                            } else {
                                alert('Failed to delete kategori.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Gagal menghapus kategori.');
                        }
                    });
                }
            });

            // Isi data pada modal edit saat tombol edit diklik
            $(document).on('click', '.editKategori', function() {
                let id = $(this).data('id');
                let nama = $(this).data('nama');

                $('#edit_id_kategori').val(id);
                $('#edit_nama_kategori').val(nama);

                $('#editKategoriModal').modal('show'); // Tampilkan modal edit
            });

            // Fungsi untuk memperbarui kategori
            $('#editKategoriForm').submit(function(e) {
                e.preventDefault(); // Mencegah form submit secara default
                let id = $('#edit_id_kategori').val();
                let nama_kategori = $('#edit_nama_kategori').val();

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/kategori/' + id,
                    type: 'PUT',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        nama: nama_kategori
                    },
                    success: function(response) {
                        alert('Kategori berhasil diperbarui.');
                        $('#editKategoriModal').modal('hide'); // Tutup modal
                        loadKategoriData(); // Reload data kategori
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal memperbarui kategori.');
                    }
                });
            });
        });
    </script>
@endsection
