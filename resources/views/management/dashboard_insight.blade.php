@extends('layouts.master')
@section('menu')
    @extends('sidebar.dashboard')
@endsection

@section('content')
    @php
        function formatNumber($number)
        {
            if ($number >= 1_000_000_000_000) {
                return number_format($number / 1_000_000_000_000, 1) . 'T';
            } elseif ($number >= 1_000_000_000) {
                return number_format($number / 1_000_000_000, 1) . 'B';
            } else {
                return number_format($number);
            }
        }
    @endphp
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
                    <h6 class="font-weight-bolder mb-0">Dashboard Insight</h6>
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

        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Emiten</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{-- {{ number_format($emitten) }} --}}5
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Value Transaksi</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{-- {{ number_format($todaysMoney) }} --}}
                                            {{ formatNumber($totals->total_value) }}
                                            {{-- <span class="text-success text-sm font-weight-bolder">+3%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Volume Transaksi</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{-- {{ number_format($todaysUsers) }} --}}
                                            {{ formatNumber($totals->total_volume) }}
                                            {{-- <span class="text-danger text-sm font-weight-bolder">-2%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-capitalize font-weight-bold">Jumlah Frequency</p>
                                        <h5 class="font-weight-bolder mb-0">
                                            {{-- {{ number_format($newClients) }} --}}
                                            {{ formatNumber($totals->total_frequency) }}
                                            {{-- <span class="text-success text-sm font-weight-bolder">+5%</span> --}}
                                        </h5>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                        <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-5 mb-lg-0 mb-4">

            </div>
            <div class="col-lg-7">
                <div class="card z-index-2">
                    <div class="input-group">
                        <span class="input-group-text text-body">
                            <i class="fas fa-calendar-alt" aria-hidden="true"></i>
                        </span>
                        <input type="month" class="form-control" placeholder="Select month and year" id="monthPicker">
                    </div>
                </div>
            </div>

            {{-- <script>
                // Script untuk mengatur nilai default bulan dan tahun saat ini
                const monthPicker = document.getElementById('monthPicker');
                const today = new Date();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const year = today.getFullYear();
                monthPicker.value = `${year}-${month}`;

                const getDaysInMonth = (year, month) => new Date(year, month, 0).getDate();

                // // Fungsi untuk memperbarui chart
                function updateChart(daysInMonth) {
                    const labels = Array.from({
                        length: daysInMonth
                    }, (_, i) => i + 1);

                    chart.data.labels = labels;
                    chart.data.datasets[0].data = Array.from({
                        length: daysInMonth
                    }, () => Math.floor(Math.random() * 500));
                    chart.data.datasets[1].data = Array.from({
                        length: daysInMonth
                    }, () => Math.floor(Math.random() * 500));

                    chart.update();
                }

                // Set default bulan ini
                const today = new Date();
                const month = String(today.getMonth() + 1).padStart(2, '0');
                const year = today.getFullYear();
                monthPicker.value = `${year}-${month}`;
                updateChart(getDaysInMonth(year, today.getMonth() + 1));

                // Event listener untuk memperbarui chart ketika bulan berubah
                monthPicker.addEventListener('change', function() {
                    const [selectedYear, selectedMonth] = monthPicker.value.split('-').map(Number);
                    const daysInMonth = getDaysInMonth(selectedYear, selectedMonth);
                    consol.log(daysInMonth)
                    updateChart(daysInMonth);
                });
            </script> --}}

        </div>

        <div class="row mt-4">
            <div class="col-lg-5 mb-lg-0 mb-4">
                <div class="card z-index-2">
                    <div class="card-body p-3">
                        <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                            <div class="chart">
                                <canvas id="chart-bars" class="chart-canvas" height="350"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card z-index-2">
                    <div class="card-header pb-0">
                        <h6>Sales overview</h6>
                        <p class="text-sm">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row">
                            <div class="col-lg-6 col-7">
                                <h6>Projects</h6>
                                <p class="text-sm mb-0">
                                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                                    <span class="font-weight-bold ms-1">30 done</span> this month
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stock Code</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Data Transaction Month</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sum Of Volume</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sum Of Value</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Sum Of Frequency</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($emitenData as $emiten)
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $emiten->stock_code }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">{{ $emiten->stock_name }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    {{ formatNumber($emiten->transaksiHarians?->sum('total_volume') ?? 0) }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="text-xs font-weight-bold">
                                                    {{ formatNumber($emiten->transaksiHarians?->sum('total_value') ?? 0) }}</span>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="text-xs font-weight-bold">{{ formatNumber($emiten->transaksiHarians?->sum('total_frequency') ?? 0) }}</span>
                                            </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card h-100">
                    <canvas id="transactionPieChart"
                        style="max-width: 350px; max-height: 350px; margin-left: 25%; margin-top: 5%;"></canvas>
                </div>
            </div>
        </div>

        <!--   Core JS Files   -->
        <script src="{{ asset('/asetbaru/assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('/asetbaru/assets/js/core/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/asetbaru/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/asetbaru/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
        <script src="{{ asset('/asetbaru/assets/js/plugins/chartjs.min.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('transactionPieChart').getContext('2d');

                // Data dari controller
                const labels = @json($labels);
                const values = @json($values);
                const percentages = @json($percentages);

                // Format angka dengan pemisah ribuan
                const formatNumber = (number) => {
                    return new Intl.NumberFormat('id-ID').format(number);
                };

                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: labels,
                        datasets: [{
                            data: values,
                            backgroundColor: [
                                '#90CDF4', // ANTM - Light blue
                                '#4299E1', // BBCA - Blue
                                '#3182CE', // BBRI - Dark blue
                                '#E9967A', // GOTO - Salmon
                                '#805AD5' // BRIS - Purple
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    generateLabels: function(chart) {
                                        const data = chart.data;
                                        return data.labels.map((label, i) => ({
                                            text: `${label} (${percentages[i]}%)`,
                                            fillStyle: chart.data.datasets[0].backgroundColor[
                                                i],
                                            hidden: false,
                                            index: i
                                        }));
                                    }
                                }
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const label = context.label || '';
                                        const value = formatNumber(context.raw);
                                        const percentage = percentages[context.dataIndex];
                                        return `${label}: ${value} (${percentage}%)`;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
             $(document).ready(function () {
    // Set default bulan dan tahun
    const today = new Date();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const year = today.getFullYear();
    $('#monthPicker').val(`${year}-${month}`);

    // Fungsi untuk memuat data frequency berdasarkan bulan dan tahun
    function loadFrequencyData(year, month) {
        $.ajax({
            url: "{{ route('dashboardInsight.getFrequencyData') }}",
            method: 'GET',
            data: { year, month },
            success: function (data) {
                const labels = ["ANTM", "BBCA", "BBRI", "BRIS", "GOTO"];
                const frequencyData = labels.map(label => {
                    const item = data.find(d => d.stock_code === label);
                    return item ? item.total_frequency : 0;
                });

                // Update chart data
                frequencyChart.data.labels = labels;
                frequencyChart.data.datasets[0].data = frequencyData;
                frequencyChart.update();
            },
            error: function (xhr) {
                console.error("Gagal mengambil data", xhr);
            }
        });
    }

    // Panggil loadFrequencyData saat halaman pertama kali dimuat
    loadFrequencyData(year, month);

    // Event listener untuk load data ketika bulan diubah
    $('#monthPicker').on('change', function () {
        const [selectedYear, selectedMonth] = this.value.split('-');
        loadFrequencyData(selectedYear, selectedMonth);
    });
});

// Setup chart
const ctx = document.getElementById("chart-bars").getContext("2d");
const frequencyChart = new Chart(ctx, {
    type: "bar",
    data: {
        labels: ["ANTM", "BBCA", "BBRI", "BRIS", "GOTO"],
        datasets: [{
            label: "Frequency",
            borderWidth: 0,
            borderRadius: 4,
            borderSkipped: false,
            backgroundColor: "#fff",
            data: [], // Akan diperbarui oleh AJAX
            maxBarThickness: 6
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: "#fff" }
            },
            x: {
                ticks: { color: "#fff" }
            }
        }
    }
});


        </script>

<script>
$(document).ready(function () {
    // Set default bulan dan tahun saat halaman pertama kali dimuat
    const today = new Date();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const year = today.getFullYear();

    $('#monthPicker').val(`${year}-${month}`); // Set default di input

    // Fungsi untuk memuat data berdasarkan bulan dan tahun
    function loadData(year, month) {
        $.ajax({
            url: "{{ route('dashboardInsight.getCloseData') }}",
            method: 'GET',
            data: { year, month },
            success: function (response) {
                const labels = response.map(item => item.day);
                const data = response.map(item => item.total_close);

                // Update chart dengan data baru
                chart.data.labels = labels;
                chart.data.datasets[0].data = data;
                chart.update();
            },
            error: function (xhr) {
                console.error("Gagal mengambil data", xhr);
            }
        });
    }

    // Panggil fungsi loadData saat halaman pertama kali dimuat
    loadData(year, month);

    // Event listener untuk load data ketika bulan diubah
    $('#monthPicker').on('change', function () {
        const [selectedYear, selectedMonth] = this.value.split('-');
        loadData(selectedYear, selectedMonth);
    });
});


    const monthPicker = document.getElementById('monthPicker');
    const ctx2 = document.getElementById("chart-line").getContext("2d");

    const getDaysInMonth = (year, month) => new Date(year, month, 0).getDate();

    const gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)');

    const gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);
    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)');

    const chart = new Chart(ctx2, {
        type: "line",
        data: {
            labels: [],
            datasets: [{
                    label: "Data Close",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    fill: true,
                    data: [],
                    maxBarThickness: 6
                },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
                    fill: true,
                    data: [],
                    maxBarThickness: 6
                },
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#b2b9bf',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });

    // Set default bulan ini
    const today = new Date();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const year = today.getFullYear();
    monthPicker.value = `${year}-${month}`;
    updateChart(getDaysInMonth(year, today.getMonth() + 1));

    // Event listener untuk memperbarui chart ketika bulan berubah
    monthPicker.addEventListener('change', function () {
        const [selectedYear, selectedMonth] = monthPicker.value.split('-').map(Number);
        const daysInMonth = getDaysInMonth(selectedYear, selectedMonth);
        updateChart(daysInMonth);
    });
</script>

        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>


        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

    </main>
@endsection
