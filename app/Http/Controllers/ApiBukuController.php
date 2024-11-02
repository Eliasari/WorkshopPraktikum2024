<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Support\Facades\Hash;

class ApiBukuController extends Controller
{
    public function index()
    {
        $data = Buku::all();
        return response()->json([
            'status' => 'success',
            'data' => $data
        ], 200);
    }

    public function ambilKategori()
    {
        $buku = Kategori::all();
        return response()->json([
            'status' => 'success',
            'data' => $buku
        ], 200);
    }

    public function show($id)
    {
        $buku = Buku::find($id);
        $kategori = Kategori::all();

        if ($buku) {
            return response()->json([
                'status' => 'success',
                'data' => $buku,
                'kategori' => $kategori
            ], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'User not found'], 404);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'create_kode' => 'required|string|max:10', // Sesuaikan nama
            'create_judul' => 'required|string|max:100', // Sesuaikan nama
            'create_pengarang' => 'required|string|max:100', // Sesuaikan nama
            'create_kategori' => 'required|exists:kategori,id',
        ]);

        $buku = new Buku;
        $buku->kode = $request->create_kode; // Perbaiki nama
        $buku->judul = $request->create_judul; // Perbaiki nama
        $buku->pengarang = $request->create_pengarang; // Perbaiki nama
        $buku->kategori_id = $request->create_kategori; // Pastikan ini sesuai

        $buku->save();

        return response()->json(['status' => 'success'], 200);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode' => 'required|string|max:10',
            'judul' => 'required|string|max:100',
            'pengarang' => 'required|string|max:100',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Buku updated successfully',
            'data' => $buku
        ], 200);
    }

    public function destroy($id)
    {
        Buku::destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Buku deleted successfully'
        ], 200);
    }

}
