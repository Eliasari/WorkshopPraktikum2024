<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Buku;

class BukuController extends Controller
{
    public function index()
    {
        $buku = Buku::with('kategori')->get();
        $kategori = Kategori::all();
        return view('management.buku', compact('buku', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode' => 'required|string|max:10',
            'judul' => 'required|string|max:100',
            'pengarang' => 'required|string|max:100',
        ]);

        Buku::create($request->all());
        return redirect()->route('buku.index');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'kode' => 'required',
            'judul' => 'required',
            'pengarang' => 'required',
        ]);

        $buku = Buku::findOrFail($id);
        $buku->kategori_id = $request->kategori_id;
        $buku->kode = $request->kode;
        $buku->judul = $request->judul;
        $buku->pengarang = $request->pengarang;
        $buku->save();

        return redirect()->route('buku.index')->with('success', 'Menu updated successfully.');
    }
    public function destroy($id)
    {
        Buku::destroy($id);

        return redirect()->route('buku.index')->with('success', 'Category deleted successfully.');
    }
}
