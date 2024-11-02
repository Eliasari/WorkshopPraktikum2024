<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GempaController extends Controller
{
    public function index(){
        $hasil = DB::table('users')->get()->toArray();
        //bisa pakai ini
        echo json_encode($hasil);
        //atau ini salah satu
        // return response()->json($hasil);
    }
}
