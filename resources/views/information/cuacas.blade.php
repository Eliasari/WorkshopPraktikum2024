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
                <button type="button" class="btn btn-primary btn-sm me-3" id="lihatDataCuaca">
                    Lihat Data Cuaca
                </button>
            </div>
        </div>

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Data Cuaca</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th id="waktuUTC"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Waktu UTC</th>
                                            <th id="waktuLokal"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Waktu Lokal</th>
                                            <th id="suhu"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Suhu</th>
                                            <th id="kelembapan"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kelembapan</th>
                                            <th id="kondisiCuacaIndonesia"
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Kondisi Cuaca dalam Indonesia</th>
                                            <th id="kondisiCuacaEnglish"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kondisi Cuaca dalam English
                                            </th>

                                            <th id="kecepatanAngin"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Kecepatan Angin</th>
                                            <th id="arahAngin"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Arah Angin</th>
                                            <th id="tutupanAwan"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Tutupan Awan</th>
                                            <th id="jarakPandang"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Jarak Pandang</th>
                                            <th id="waktuProduksi"
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Waktu Produksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-cuaca-body"> <!-- Tambahkan id pada tbody -->
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
            $('#lihatDataCuaca').click(function() {
                $.ajax({
                    url: 'https://api.bmkg.go.id/publik/prakiraan-cuaca?adm4=31.71.04.1004',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); 
                        let cuaca = data.Infocuaca.cuaca;
                        let tableBody = $('#data-cuaca-body');
                        tableBody.empty();
                        cuaca.forEach(function(item) {
                            let row = `
                        <tr>
                            <td>${item.waktuUTC}</td>
                            <td>${item.waktuLokal}</td>
                            <td>${item.suhu}</td>
                            <td>${item.kelembapan}</td>
                            <td>${item.kondisiCuacaIndonesia}</td>
                            <td>${item.kondisiCuacaEnglish}</td>
                            <td>${item.kecepatanAngin}</td>
                            <td>${item.arahAngin}</td>
                            <td>${item.tutupanAwan}</td>
                            <td>${item.jarakPandang}</td>
                            <td>${item.waktuProduksi}</td>
                        </tr>
                    `;
                            // Tambahkan baris ke dalam tabel
                            tableBody.append(row);
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Data Cuaca Tidak Ada ' + error);
                        console.log(xhr
                            .responseText); // Ini akan membantu untuk melihat error dari API
                    }
                });
            });
        });
    </script>
@endsection
