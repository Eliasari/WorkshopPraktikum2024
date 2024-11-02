@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection


@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" />
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
                    <h6 class="font-weight-bolder mb-0">Menu Buku</h6>
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
                    Add New Buku
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Buku List</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="bukuTable" class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nomor Buku</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kode</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Judul</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Pengarang</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kategori</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bukuTableBody">
                                        <!-- Data akan dimuat di sini oleh jQuery -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- edit --}}
            <div class="modal fade" id="editBukuModal" tabindex="-1" aria-labelledby="editBukuModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editBukuModalLabel">Edit Kategori</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editBukuForm">
                                <input type="hidden" id="edit_id_buku">
                                <div class="form-group">
                                    <label for="edit_kode">Kode</label>
                                    <input type="text" class="form-control" id="edit_kode" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_judul">Judul</label>
                                    <input type="text" class="form-control" id="edit_judul" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_pengarang">Pengarang</label>
                                    <input type="text" class="form-control" id="edit_pengarang" required>
                                </div>

                                <div class="form-group">
                                    <label for="edit_kategori">Kategori</label>
                                    <select class="form-control" id="edit_kategori">
                                        <!-- Data jenis user akan diisi secara dinamis -->
                                    </select>
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

            <!-- Modal Add User -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add New Buku</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createBukuForm">
                                @csrf
                                <div class="form-group">
                                    <label for="create_kode">Kode</label>
                                    <input type="text" class="form-control" id="create_kode" name="create_kode"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="create_judul">Judul</label>
                                    <input type="text" class="form-control" id="create_judul" name="create_judul"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label for="create_pengarang">Pengarang</label>
                                    <input type="text" class="form-control" id="create_pengarang"
                                        name="create_pengarang" required>
                                </div>

                                <div class="form-group">
                                    <label for="create_kategori">Kategori</label>
                                    <select class="form-control" id="create_kategori" name="create_kategori">
                                        <!-- Data jenis user akan diisi secara dinamis -->
                                    </select>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Load kategori untuk dropdown
            $.ajax({
                url: 'http://127.0.0.1:8000/api/kategori',
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        var kategori = response.data;
                        var select = $('#edit_kategori');
                        var select_create = $('#create_kategori');

                        // Kosongkan select terlebih dahulu
                        select.empty();
                        select_create.empty(); // Kosongkan dropdown create juga

                        // Loop melalui data kategori dan tambahkan opsi ke dropdown
                        $.each(kategori, function(index, kategori) {
                            select.append('<option value="' + kategori.id + '">' + kategori
                                .nama + '</option>');
                            select_create.append('<option value="' + kategori.id + '">' +
                                kategori.nama + '</option>');
                        });
                    } else {
                        alert('Failed to fetch data.');
                    }
                },
                error: function() {
                    alert('Something went wrong.');
                }
            });

            // Load data buku
            function loadBuku() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/buku',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let buku = response.data; // Menggunakan nama variabel buku
                            let tableBody = $('#bukuTableBody');
                            tableBody.empty();

                            $.each(buku, function(index, buku) { // Menggunakan nama variabel buku
                                let row = `
                                    <tr>
                                        <td><p class="text-sm font-weight-bold mb-0">${buku.id}</p></td>
                                        <td><p class="text-sm font-weight-bold mb-0">${buku.kode}</p></td>
                                        <td><p class="text-sm font-weight-bold mb-0">${buku.judul}</p></td>
                                        <td><p class="text-sm font-weight-bold mb-0">${buku.pengarang}</p></td>
                                        <td><p class="text-sm font-weight-bold mb-0">${buku.kategori_id}</p></td>
                                        <td>
                                            <a href="#" class="editBuku" data-id="${buku.id}" data-nama="${buku.nama}"><i class="bi bi-pencil-square" style="color: #6c757d;"></i></a>
                                            <a href="#" class="deleteBuku" data-id="${buku.id}" data-toggle="tooltip" data-original-title="Delete Buku"><i class="bi bi-trash" style="color: #6c757d;"></i></a>
                                        </td>
                                    </tr>
                                `;
                                tableBody.append(row);
                            });


                            if ($.fn.DataTable.isDataTable('#bukuTable')) {
                                $('#bukuTable').DataTable().destroy();
                            }

                            $('#bukuTable').DataTable({
                                "paging": true,
                                "searching": true,
                                "ordering": true,
                                "pageLength": 10,
                                "lengthMenu": [5, 10, 25, 50]
                            });

                        } else {
                            alert('Failed to retrieve data.');
                        }
                    },
                    error: function() {
                        alert('Failed to retrieve data.');
                    }
                });
            }

            loadBuku();

            $('#createBukuForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/createBuku',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Buku successfully added.');
                            $('#closeModalButton').click();
                            loadBuku();
                        } else {
                            alert('Failed to add buku.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseJSON
                        .message);
                    }
                });
            });


            $(document).on('click', '.deleteBuku', function() {
                var id = $(this).data('id');
                if (confirm('Are you sure you want to delete this buku?')) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/buku/' + id,
                        method: 'DELETE',
                        success: function(response) {
                            loadBuku();
                            alert('Buku deleted successfully');
                        },
                        error: function(xhr) {
                            alert('Error deleting buku: ' + xhr.responseJSON.message);
                        }
                    });
                }
            });

            $(document).on('click', '.editBuku', function() {
                var id = $(this).data('id');
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/buku/' + id,
                    method: 'GET',
                    success: function(response) {
                        $('#edit_id_buku').val(response.data.id);
                        $('#edit_kode').val(response.data.kode);
                        $('#edit_judul').val(response.data.judul);
                        $('#edit_pengarang').val(response.data.pengarang);
                        $('#edit_kategori').val(response.data.kategori_id);
                        $('#editBukuModal').modal('show');
                    }
                });
            });

            $('#editBukuForm').submit(function(e) {
                e.preventDefault();
                var id = $('#edit_id_buku').val();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/buku/' + id,
                    method: 'PUT',
                    data: {
                        kategori_id: $('#edit_kategori').val(),
                        kode: $('#edit_kode').val(),
                        judul: $('#edit_judul').val(),
                        pengarang: $('#edit_pengarang').val()
                    },
                    success: function(response) {
                        $('#editBukuModal').modal('hide');
                        loadBuku();
                        alert('Buku updated successfully');
                    },
                    error: function(xhr) {
                        alert('Error updating buku: ' + xhr.responseJSON.message);
                    }
                });
            });
        });
    </script>
@endsection
