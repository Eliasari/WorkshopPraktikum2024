<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use App\Models\PostingKomentar;
use App\Models\Posting;
use Illuminate\Support\Facades\Auth;

class ApiKomentarController extends Controller
{
    // Menampilkan semua komentar berdasarkan posting_id
    public function show($id)
    {
        $komentar = Komentar::where('posting_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json(['status' => true, 'komentar' => $komentar], 200);
    }

    // Menyimpan komentar baru
    public function store(Request $request, $id)

    {

        $request->validate([
            'komentar_text' => 'required|string'
        ]);

        try {
            $komentar = Komentar::create([
                'id_user' => Auth::user()->id_user,
                'posting_id' => $id,
                'komentar_text' => $request->komentar_text,
                'komentar_gambar' => '-',
                'create_by' => Auth::user()->id_user
            ]);

            return response()->json(['status' => true, 'komentar' => $komentar], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => 'Gagal menyimpan komentar. Silakan coba lagi.'], 500);
        }
    }

    // Menghapus komentar berdasarkan ID
    public function destroy($id, $komentarId)
    {
        $komentar = Komentar::where('posting_id', $id)
            ->where('id', $komentarId)
            ->first();

        if (!$komentar) {
            return response()->json(['status' => false, 'message' => 'Komentar tidak ditemukan.'], 404);
        }

        if ($komentar->id_user !== Auth::user()->id_user) {
            return response()->json(['status' => false, 'message' => 'Unauthorized'], 403);
        }

        $komentar->delete();

        return response()->json(['status' => true, 'message' => 'Komentar berhasil dihapus.'], 200);
    }

}
