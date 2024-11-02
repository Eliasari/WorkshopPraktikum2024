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
                    <h6 class="font-weight-bolder mb-0">Menu Levels</h6>
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
                    Add New Menu Level
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Menu Levels</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center ps-2">
                                                Nomor</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Levels</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Create_by</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Modify</th>
                                        </tr>
                                    </thead>
                                    <tbody id="menuLevelTableBody">
                                        <!-- Data akan dimuat di sini oleh jQuery -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editMenuLevelModal" tabindex="-1" aria-labelledby="editMenuLevelModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editMenuLevelModalLabel">Edit Menu Level</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editMenuLevelForm">
                                <input type="hidden" id="edit_id_menu_level">
                                <div class="form-group">
                                    <label for="edit_level">Level</label>
                                    <input type="text" class="form-control" id="edit_level" required>
                                </div>
                                <div class="form-group">
                                    <label for="edit_create_by">Create By</label>
                                    <input type="text" class="form-control" id="edit_create_by" required>
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
                            <h5 class="modal-title" id="createModalLabel">Tambah Menu Levels</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createMenuLevelForm">
                                @csrf
                                <div class="form-group">
                                    <label for="level">Nomor Levels</label>
                                    <input type="number" class="form-control" id="id_level" name="id_level" required>
                                </div>
                                <div class="form-group">
                                    <label for="level">Nama Levels</label>
                                    <input type="text" class="form-control" id="level" name="level" required>
                                </div>
                                <div class="form-group">
                                    <label for="create_by">Create By</label>
                                    <input type="text" class="form-control" id="create_by" name="create_by" required>
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
            // Fungsi untuk memuat data Menu Level
            function loadMenuLevelData() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menuLevel',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let menuLevelData = response.data;
                            let tableBody = $('#menuLevelTableBody');
                            tableBody.empty();

                            $.each(menuLevelData, function(index, menuLevel) {
                                let row = `
                <tr>
                    <td class="text-center">${index + 1}</td>
                    <td>${menuLevel.level}</td>
                    <td>${menuLevel.create_by}</td>
                    <td>
                        <a href="#" class="editMenuLevel" data-id="${menuLevel.id_level}" data-level="${menuLevel.level}" data-create_by="${menuLevel.create_by}">
                            <i class="bi bi-pencil-square" style="color: #6c757d;"></i>
                        </a>
                        <a href="#" class="deleteMenuLevel" data-id="${menuLevel.id_level}">
                            <i class="bi bi-trash" style="color: #6c757d;"></i>
                        </a>
                    </td>
                </tr>`;
                                tableBody.append(row);
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal mengambil data Menu Level.');
                    }
                });
            }

            loadMenuLevelData(); // Panggil fungsi untuk memuat data saat halaman pertama kali dimuat

            // Fungsi untuk menambah Menu Level baru
            $('#createMenuLevelForm').submit(function(e) {
                e.preventDefault();

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/createMenuLevel',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Menu Level successfully added.');
                            $('#closeModalButton').click(); // Tutup modal setelah sukses
                            loadMenuLevelData(); // Reload data
                        } else {
                            alert('Failed to add Menu Level.');
                        }
                    },
                    error: function(xhr) {
                        alert('An error occurred: ' + xhr.responseText);
                    }
                });
            });

            // Fungsi untuk menghapus Menu Level
            $(document).on('click', '.deleteMenuLevel', function(e) {
                e.preventDefault();
                let id_menu_level = $(this).data('id');
                let confirmation = confirm('Apakah Anda yakin ingin menghapus Menu Level ini?');

                if (confirmation) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/menuLevel/' + id_menu_level,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('Menu Level successfully deleted.');
                                loadMenuLevelData();
                            } else {
                                alert('Failed to delete Menu Level.');
                            }
                        },
                        error: function(xhr, status, error) {
                            alert('Gagal menghapus Menu Level.');
                        }
                    });
                }
            });

            $(document).on('click', '.editMenuLevel', function() {
                let id = $(this).data('id');
                let level = $(this).data('level');
                let create_by = $(this).data('create_by');

                $('#edit_id_menu_level').val(id);
                $('#edit_level').val(level);
                $('#edit_create_by').val(create_by);

                $('#editMenuLevelModal').modal('show'); // Tampilkan modal edit
            });

            // Fungsi untuk memperbarui Menu Level
            $('#editMenuLevelForm').submit(function(e) {
                e.preventDefault();
                let id = $('#edit_id_menu_level').val();
                let level = $('#edit_level').val();
                let create_by = $('#edit_create_by').val();

                $.ajax({
                    url: 'http://127.0.0.1:8000/api/menuLevel/' + id,
                    type: 'PUT',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        level: level,
                        create_by: create_by
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('Menu Level berhasil diperbarui.');
                            $('#editMenuLevelModal').modal('hide'); // Tutup modal edit
                            loadMenuLevelData(); // Reload data Menu Level
                        } else {
                            alert('Gagal memperbarui Menu Level: ' + response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        let errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr
                            .responseJSON.message : 'Gagal memperbarui Menu Level.';
                        alert(errorMessage);
                    }
                });
            });

        });
    </script>
@endsection
