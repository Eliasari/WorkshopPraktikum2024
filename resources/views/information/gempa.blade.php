{{-- @extends('layouts.master')
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
                    <h6 class="font-weight-bolder mb-0">Menu</h6>
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
                <button type="button" class="btn btn-primary btn-sm me-3" id="lihatDataGempa">
                    Lihat Data Gempa
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Gempa</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th
                                                id="tanggal" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Tanggal</th>
                                            <th
                                                id="jam" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jam</th>
                                            <th
                                                id="waktu" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Waktu</th>
                                            <th
                                                id="koordinat" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Koordinat</th>
                                            <th
                                                id="lintang" class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Lintang</th>
                                            <th
                                                id="bujur" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Bujur</th>
                                            <th
                                                id="magnitudo" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Magnitudo</th>
                                            <th
                                                id="magnitudo" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kedalaman</th>
                                            <th
                                                id="wilayah" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Wilayah</th>
                                            <th
                                                id="potensi" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Potensi</th>
                                            <th
                                                id="dirasakan" class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Dirasakan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-gempa-body"> <!-- Tambahkan id pada tbody -->
                                        <!-- Data akan diisi di sini -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lihatDataGempa').click(function() {
                $.ajax({
                    url: 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                let gempa = data.Infogempa.gempa;
                let tableBody = $('#data-gempa-body'); // Target tbody dengan id

                // Kosongkan tabel sebelum diisi
                tableBody.empty();

                // Buat baris baru untuk data gempa
                let row = `
                    <tr>
                        <td>${gempa.Tanggal}</td>
                        <td>${gempa.Jam}</td>
                        <td>${gempa.DateTime}</td>
                        <td>${gempa.Coordinates}</td>
                        <td>${gempa.Lintang}</td>
                        <td>${gempa.Bujur}</td>
                        <td>${gempa.Magnitude}</td>
                        <td>${gempa.Kedalaman}</td>
                        <td>${gempa.Wilayah}</td>
                        <td>${gempa.Potensi}</td>
                        <td>${gempa.Dirasakan || '-'}</td>
                        <td><img style="width: 100px;" src="https://static.bmkg.go.id/${gempa.Shakemap}" alt="Peta Gempa"></td>
                    </tr>
                `;

                // Tambahkan baris baru ke dalam tabel
                tableBody.append(row);
            },
            error: function(error) {
                alert('Terjadi kesalahan dalam memuat data.');
            }
                });
            });
        });
        </script>
@endsection --}}


@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection
@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur"
            navbar-scroll="true">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
                        <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><a
                                href="{{ route('home') }}">Dashboard</a></li>
                    </ol>
                    <h6 class="font-weight-bolder mb-0">Menu</h6>
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
                <button type="button" class="btn btn-primary btn-sm me-3" id="lihatDataGempa">
                    Lihat Data Gempa
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row" id="data-gempa-cards">
                <!-- Cards akan diisi di sini -->
            </div>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#lihatDataGempa').click(function() {
                $.ajax({
                    url: 'https://data.bmkg.go.id/DataMKG/TEWS/autogempa.json',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        let gempa = data.Infogempa.gempa;
                        let cardContainer = $('#data-gempa-cards');

                        // Kosongkan container sebelum diisi
                        cardContainer.empty();

                        // Buat card baru untuk data gempa
                        let card = `
                            <div class="col-md-4">
                                <div class="card mb-4 shadow-lg border-0">
                                    <img class="card-img-top" style="height: 200px; object-fit: cover;" src="https://static.bmkg.go.id/${gempa.Shakemap}" alt="Peta Gempa">
                                    <div class="card-body">
                                        <h5 class="card-title font-weight-bold text-primary">${gempa.Wilayah}</h5>
                                        <p class="card-text text-muted">
                                            <i class="bi bi-calendar3"></i> ${gempa.Tanggal} | <i class="bi bi-clock"></i> ${gempa.Jam}
                                        </p>
                                        <p class="card-text">
                                            <strong>Magnitudo:</strong> ${gempa.Magnitude} <br>
                                            <strong>Kedalaman:</strong> ${gempa.Kedalaman} <br>
                                            <strong>Koordinat:</strong> ${gempa.Coordinates} <br>
                                            <strong>Potensi:</strong> ${gempa.Potensi} <br>
                                            <strong>Dirasakan:</strong> ${gempa.Dirasakan || '-'}
                                        </p>
                                        <a href="#" class="btn btn-outline-primary btn-sm">Detail</a>
                                    </div>
                                </div>
                            </div>
                        `;

                        // Tambahkan card baru ke dalam container
                        cardContainer.append(card);
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan dalam memuat data.');
                    }
                });
            });
        });
    </script>
@endsection
