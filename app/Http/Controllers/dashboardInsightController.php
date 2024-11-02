<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Emiten;
use App\Models\TransaksiHarian;
use Carbon\Carbon;

class dashboardInsightController extends Controller
{
    function index()
    {
        $emitenData = Emiten::with(['transaksiHarians' => function ($query) {
            $query->select('stock_code')
                ->selectRaw('SUM(volume) as total_volume')
                ->selectRaw('SUM(value) as total_value')
                ->selectRaw('SUM(frequency) as total_frequency')
                ->groupBy('stock_code');
        }])->get();

        // Total transaksi
        $totals = TransaksiHarian::selectRaw('SUM(volume) as total_volume, SUM(value) as total_value, SUM(frequency) as total_frequency')
            ->first();

        // Siapkan data untuk pie chart
        $labels = $emitenData->pluck('stock_code')->toArray();
        $values = $emitenData->map(function ($emiten) {
            return $emiten->transaksiHarians->sum('total_value');
        })->toArray();

        $frequencies = $emitenData->map(function ($emiten) {
            return $emiten->transaksiHarians->sum('total_frequency');
        })->toArray();

        // Hitung persentase
        $totalFreq = array_sum($frequencies);
        $percentagesFreq = array_map(function ($freq) use ($totalFreq) {
            return round(($freq / $totalFreq) * 100, 2);
        }, $frequencies);

        $totalValue = array_sum($values);
        $percentages = array_map(function ($value) use ($totalValue) {
            return round(($value / $totalValue) * 100, 2);
        }, $values);

        // Ambil data untuk chart
        $stockCodes = Emiten::pluck('stock_code')->toArray();
        $data = TransaksiHarian::whereIn('stock_code', $stockCodes)
            ->orderBy('date_transaction')
            ->get()
            ->groupBy('stock_code');

        $formattedData = [];
        foreach ($stockCodes as $code) {
            $formattedData[$code] = isset($data[$code]) ? $data[$code]->pluck('close')->toArray() : [];
        }

        $dates = TransaksiHarian::whereIn('stock_code', $stockCodes)
            ->orderBy('date_transaction')
            ->pluck('date_transaction')
            ->unique()
            ->take(30)
            ->toArray();

        $valuesForChart = TransaksiHarian::whereIn('stock_code', $stockCodes)
            ->selectRaw('SUM(frequency) as frequency, date_transaction')
            ->groupBy('date_transaction')
            ->orderBy('date_transaction')
            ->pluck('frequency')
            ->toArray();

        $colors = [
            'ANTM' => 'rgba(75, 192, 192, 1)',
            'BBCA' => 'rgba(54, 162, 235, 1)',
            'BBRI' => 'rgba(153, 102, 255, 1)',
            'BRIS' => 'rgba(255, 159, 64, 1)',
            'GOTO' => 'rgba(255, 99, 132, 1)',
        ];

        return view('management.dashboard_insight', compact('colors', 'emitenData', 'totals', 'labels', 'values', 'percentages', 'frequencies', 'formattedData', 'dates', 'stockCodes', 'valuesForChart'));
    }

    public function getCloseData(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        // Jumlah hari dalam bulan yang dipilih
        $daysInMonth = Carbon::createFromDate($year, $month)->daysInMonth;

        // Buat array default untuk jumlah hari dalam bulan, dengan nilai total_close = 0
        $data = collect(range(1, $daysInMonth))->map(function ($day) {
            return [
                'day' => $day,
                'total_close' => 0
            ];
        });

        // Ambil data transaksi dari database berdasarkan bulan dan tahun yang dipilih
        $transactions = TransaksiHarian::whereYear('date_transaction', $year)
            ->whereMonth('date_transaction', $month)
            ->selectRaw('DAY(date_transaction) as day, SUM(close) as total_close')
            ->groupBy('day')
            ->orderBy('day')
            ->get();

        // Gabungkan data transaksi ke array default
        $data = $data->map(function ($default) use ($transactions) {
            $transaction = $transactions->firstWhere('day', $default['day']);
            if ($transaction) {
                $default['total_close'] = $transaction->total_close;
            }
            return $default;
        });

        return response()->json($data);
    }

    public function getFrequencyData(Request $request)
{
    $year = $request->year;
    $month = $request->month;

    $data = TransaksiHarian::whereYear('date_transaction', $year)
        ->whereMonth('date_transaction', $month)
        ->whereIn('stock_code', ['ANTM', 'BBCA', 'BBRI', 'BRIS', 'GOTO'])
        ->selectRaw('stock_code, SUM(frequency) as total_frequency')
        ->groupBy('stock_code')
        ->orderBy('stock_code')
        ->get();

    return response()->json($data);
}

}
