<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function showKategori()
    {
        $kategori = Kategori::all();
        return view('management.kategori', compact('kategori'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ]);

        Kategori::create($request->all());
        return redirect()->route('show.kategori');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:50',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->nama = $request->input('nama');
        $kategori->save();

        return redirect()->route('show.kategori')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);

        return redirect()->route('show.kategori')->with('success', 'Category deleted successfully.');
    }
}
