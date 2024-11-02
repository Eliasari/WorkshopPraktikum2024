<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TransactionListController extends Controller
{
    function index(){
        $totalVolume = DB::table('transaksi_harians')->sum('volume');
        $totalValue = DB::table('transaksi_harians')->sum('value');
        $totalfrequency = DB::table('transaksi_harians')->sum('frequency');

        $transactionsPerMonth = DB::table('transaksi_harians')
            ->selectRaw('stock_code,
                         DATE_FORMAT(date_transaction, "%M %Y") as month,
                         SUM(volume) as sum_volume,
                         SUM(value) as sum_value,
                         SUM(frequency) as sum_frequency')
            ->whereYear('date_transaction', 2023)
            ->groupBy('stock_code', 'month')
            ->orderBy('month')
            ->get();

        $stockCodes = DB::table('transaksi_harians')->pluck('stock_code')->implode(', ');
        return view('management.transaksi', compact('totalVolume', 'totalValue', 'totalfrequency', 'stockCodes', 'transactionsPerMonth'));
    }
}
