@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection

@section('content')

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
                <h6 class="font-weight-bolder mb-0">Transaksi</h6>
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

    <div style="display: flex; justify-content: flex-end; margin-right: 2.5%;">
        <button class="btn btn-primary" id="download">Download PDF</button>
    </div>

<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Transaksi List</h6>
                </div>

                <div class="card-body px-0 pb-2">
                    <div id="content" class="table-responsive">
                      <table class="table align-items-center mb-0">
                        <thead>
                          <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Stock Code</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Data Transaction Month</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sum Of Volume</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sum Of Value</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sum Of Frequency</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($transactionsPerMonth as $transaction)
                              <tr>
                                <td>
                                  <div class="d-flex px-2 py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                      <h6 class="mb-0 text-sm">{{ $transaction->stock_code }}</h6>
                                    </div>
                                  </div>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-xs font-weight-bold">{{ $transaction->month }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-xs font-weight-bold">{{ number_format($transaction->sum_volume, 0, ',', '.') }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-xs font-weight-bold">{{ number_format($transaction->sum_value, 0, ',', '.') }}</span>
                                </td>
                                <td class="align-middle text-center text-sm">
                                  <span class="text-xs font-weight-bold">{{ number_format($transaction->sum_frequency, 0, ',', '.') }}</span>
                                </td>
                              </tr>
                            @endforeach
                          </tbody>
                      </table>

                      <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
                      <script>
                        document.getElementById('download').addEventListener('click', function () {
                            var element = document.getElementById('content');
                            html2pdf()
                                .from(element)
                                .save();
                        });
                    </script>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
