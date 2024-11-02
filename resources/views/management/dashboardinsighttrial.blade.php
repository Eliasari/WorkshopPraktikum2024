@extends('layouts.master')

@section('menu')
    @extends('sidebar.dashboard')
@endsection

@section('content')
    <div class="col-md-12">
        <div class="row mt-4">
            <div class="col-md-3">Jumlah Emiten: {{ $emitten }}</div>
            <div class="col-md-3">Volume Transaksi: {{ number_format($totalVolume / 1e9, 1) }}B</div>
            <div class="col-md-3">Value Transaksi: {{ number_format($totalValue / 1e12, 1) }}T</div>
            <div class="col-md-3">Jumlah frekuensi: {{ $totalClose }}</div>
        </div>

        <canvas id="pieChart" class="mt-4"></canvas>
        <canvas id="barChart" class="mt-4"></canvas>
        <canvas id="lineChart" class="mt-4"></canvas>

        <script>
            const ctxPie = document.getElementById('pieChart').getContext('2d');
            const ctxBar = document.getElementById('barChart').getContext('2d');
            const ctxLine = document.getElementById('lineChart').getContext('2d');

            const labels = @json($stockCodes->pluck('stock_code'));
            const values = @json($totalValue->pluck('value'));
            const frequencies = @json($totalClose->pluck('frequency'));

            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                    }]
                }
            });

            new Chart(ctxBar, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Frekuensi',
                        data: frequencies,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                }
            });

            // Contoh data untuk grafik garis
            const closingPrices = [1000, 2000, 3000, 4000, 5000]; // Ganti dengan data harga penutupan yang sesuai
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Grafik Harga Close',
                        data: closingPrices,
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                }
            });
        </script>
    </div>
@endsection
