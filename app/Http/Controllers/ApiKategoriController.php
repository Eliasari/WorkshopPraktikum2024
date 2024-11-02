<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class ApiKategoriController extends Controller
{

       public function showKategori()
       {
           $kategori = Kategori::all();
           return response()->json([
            'status' => 'success',
            'data' => $kategori,
        ], 200);
       }

       public function store(Request $request)
       {
           $request->validate([
               'nama' => 'required|string|max:50',
           ]);

           $kategori = Kategori::create($request->all());
           return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully',
            'kategori' => $kategori
        ], 201);
       }

       public function update(Request $request, $id)
       {
           $request->validate([
               'nama' => 'required|string|max:50',
           ]);

           $kategori = Kategori::findOrFail($id);
           $kategori->nama = $request->input('nama');
           $kategori->save();

           return response()->json([
               'message' => 'Category updated successfully',
               'kategori' => $kategori
           ]);
       }

       public function destroy($id)
       {
           $kategori = Kategori::findOrFail($id);
           $kategori->delete();

           return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ]);

       }
}
