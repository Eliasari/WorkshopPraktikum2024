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
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a>
                        </li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a
                                href="{{ route('home') }}">Dashboard</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Menu User</h6>
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
                    Add New User
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>User List</h6>
                        </div>

                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table id="userTable" class="display table align-items-center justify-content-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                No</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Nama User</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Username</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Password</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Email</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                No Hp</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                WA</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Pin</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Jenis User</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="userTableBody">
                                        <!-- Data akan dimuat di sini oleh jQuery -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Edit User -->
            <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editUserForm">
                                <input type="hidden" id="edit_id_user">

                                <!-- Nama User -->
                                <div class="form-group">
                                    <label for="edit_nama_user">Nama User</label>
                                    <input type="text" class="form-control" id="edit_nama_user" required>
                                </div>

                                <!-- Username -->
                                <div class="form-group">
                                    <label for="edit_username">Username</label>
                                    <input type="text" class="form-control" id="edit_username" required>
                                </div>

                                <!-- Email -->
                                <div class="form-group">
                                    <label for="edit_email">Email</label>
                                    <input type="email" class="form-control" id="edit_email" required>
                                </div>

                                <!-- No HP -->
                                <div class="form-group">
                                    <label for="edit_no_hp">No HP</label>
                                    <input type="text" class="form-control" id="edit_no_hp" required>
                                </div>

                                <!-- WA -->
                                <div class="form-group">
                                    <label for="edit_wa">WA</label>
                                    <input type="text" class="form-control" id="edit_wa">
                                </div>

                                <!-- Pin -->
                                <div class="form-group">
                                    <label for="edit_pin">Pin</label>
                                    <input type="text" class="form-control" id="edit_pin">
                                </div>

                                <!-- Jenis User -->
                                <div class="form-group">
                                    <label for="edit_jenis_user">Jenis User</label>
                                    <select class="form-control" id="edit_jenis_user">
                                        <!-- Data jenis user akan diisi secara dinamis -->
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Add User -->
            <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add New User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="createUserForm">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_user">Nama User</label>
                                    <input type="text" class="form-control" id="nama_user" name="nama_user" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="form-group">
                                    <label for="no_hp">No HP</label>
                                    <input type="text" class="form-control" id="no_hp" name="no_hp" required>
                                </div>

                                <div class="form-group">
                                    <label for="wa">WA</label>
                                    <input type="text" class="form-control" id="wa" name="wa" required>
                                </div>

                                <div class="form-group">
                                    <label for="pin">PIN</label>
                                    <input type="text" class="form-control" id="pin" name="pin" required>
                                </div>

                                <div class="form-group">
                                    <label for="create_jenis_user">Jenis User</label>
                                    <select class="form-control" id="create_jenis_user" name="create_jenis_user">
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
            function loadUserData() {
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/coba',
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            let users = response.data;
                            let tableBody = $('#userTableBody');
                            tableBody.empty();

                            $.each(users, function(index, user) {
                                let row = `
                        <tr>
                            <td class="text-center"><h6 class="text-sm font-weight-bold mb-0">${index + 1}</h6></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.nama_user}</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.username}</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">**</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.email}</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.no_hp}</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.wa ?? '-'}</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.pin ?? '-'}</p></td>
                            <td><p class="text-sm font-weight-bold mb-0">${user.id_jenis_user}</p></td>
                            <td class="align-middle">
                                <a href="#" class="editUser" data-id="${user.id_user}"><i class="bi bi-pencil-square" style="color: #6c757d;"></i></a>
                                <a href="#" class="deleteUser" data-id="${user.id_user}" data-toggle="tooltip" data-original-title="Delete User"><i class="bi bi-trash" style="color: #6c757d;"></i></a>
                            </td>
                        </tr>
                    `;
                                tableBody.append(row);
                            });

                            if ($.fn.DataTable.isDataTable('#userTable')) {
                                $('#userTable').DataTable().destroy();
                            }

                            $('#userTable').DataTable({
                                "paging": true,
                                "searching": true,
                                "ordering": true,
                                "pageLength": 10,
                                "lengthMenu": [5, 10, 25, 50]
                            });
                        }
                    },
                    error: function() {
                        alert('Failed to retrieve data.');
                    }
                });
            }

            loadUserData();


            $.ajax({
                url: 'http://127.0.0.1:8000/api/ambilJenisUser',
                type: 'GET',
                success: function(response) {
                    if (response.status === 'success') {
                        var jenisUsers = response.data;
                        var select = $('#edit_jenis_user');
                        var select_create = $('#create_jenis_user');

                        select.empty();
                        select_create.empty();

                        $.each(jenisUsers, function(index, jenisUser) {
                            select.append('<option value="' + jenisUser.id_jenis_user + '">' +
                                jenisUser.jenis_user + '</option>');
                            select_create.append('<option value="' + jenisUser.id_jenis_user +
                                '">' + jenisUser.jenis_user + '</option>');
                        });
                    } else {
                        alert('Failed to fetch data.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Something went wrong.');
                }
            });

            // Handle create user form submission
            $('#createUserForm').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'http://127.0.0.1:8000/api/createUser',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('User successfully added.');
                            $('#closeModalButton').click();
                            loadUserData(); // Reload user data
                        } else {
                            alert('Failed to add user.');
                        }
                    },
                    error: function() {
                        alert('An error occurred while adding the user.');
                    }
                });
            });

            // Handle delete user action
            $(document).on('click', '.deleteUser', function(e) {
                e.preventDefault();
                var id_user = $(this).data('id');
                var confirmation = confirm('Are you sure you want to delete this user?');

                if (confirmation) {
                    $.ajax({
                        url: 'http://127.0.0.1:8000/api/deleteUser/' + id_user,
                        type: 'DELETE',
                        success: function(response) {
                            if (response.status === 'success') {
                                alert('User successfully deleted.');
                                loadUserData();
                            } else {
                                alert('Failed to delete user.');
                            }
                        },
                        error: function() {
                            alert('An error occurred while deleting the user.');
                        }
                    });
                }
            });

            // Handle edit user action
            $('body').on('click', '.editUser', function() {
                var id_user = $(this).data('id');
                $.ajax({
                    url: `http://127.0.0.1:8000/api/coba/${id_user}`,
                    type: 'GET',
                    success: function(response) {
                        if (response.status === 'success') {
                            let user = response.data;
                            $('#edit_id_user').val(user.id_user);
                            $('#edit_nama_user').val(user.nama_user);
                            $('#edit_username').val(user.username);
                            $('#edit_email').val(user.email);
                            $('#edit_no_hp').val(user.no_hp);
                            $('#edit_wa').val(user.wa);
                            $('#edit_pin').val(user.pin);
                            $('#edit_jenis_user').val(user.id_jenis_user);

                            $('#editUserModal').modal('show');
                        }
                    }
                });
            });

            // Handle form submit for updating user
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                let id_user = $('#edit_id_user').val();
                let data = {
                    nama_user: $('#edit_nama_user').val(),
                    username: $('#edit_username').val(),
                    email: $('#edit_email').val(),
                    no_hp: $('#edit_no_hp').val(),
                    wa: $('#edit_wa').val(),
                    pin: $('#edit_pin').val(),
                    id_jenis_user: $('#edit_jenis_user').val(),
                };

                $.ajax({
                    url: `http://127.0.0.1:8000/api/coba/${id_user}`,
                    type: 'PUT',
                    data: data,
                    success: function(response) {
                        if (response.status === 'success') {
                            alert('User updated successfully');
                            $('#editUserModal').modal('hide');
                            loadUserData();
                        } else {
                            alert('Failed to update user.');
                        }
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                });
            });
        });
    </script>
@endsection
