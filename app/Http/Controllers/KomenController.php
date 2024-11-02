<?php

namespace App\Http\Controllers;

use App\Models\Komentar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KomenController extends Controller
{
    public function store(Request $request, $postingId){

        $request->validate([
            'komentar_text' => 'required|string'
        ]);

        Komentar::create([
            'id_user' => Auth::user()->id_user,
            'posting_id' => $postingId,
            'komentar_text' => $request->komentar_text,
            'komentar_gambar' => '-',
            'create_by' =>Auth::user()->id_user
        ]);

        return back();

    }

    // public function show($postingId)
    // {
    //     // Ambil komentar berdasarkan posting_id
    //     $komentar = Komentar::where('posting_id', $postingId)->with('user')->get();

    //     // Kembalikan data dalam format JSON jika AJAX
    //     return response()->json([
    //         'status' => true,
    //         'comments' => $komentar->map(function ($item) {
    //             return [
    //                 'komentar_text' => $item->komentar_text,
    //                 'created_at' => $item->created_at->diffForHumans(),
    //                 'user' => [
    //                     'username' => $item->user->username
    //                 ]
    //             ];
    //         })
    //     ]);
    // }

    // public function store(Request $request, $posting)
    // {
    //     $request->validate([
    //         'komentar_text' => 'required|string'
    //     ]);

    //     // Simpan komentar
    //     $komentar = Komentar::create([
    //         'id_user' => Auth::user()->id_user,
    //         'posting_id' => $posting,
    //         'komentar_text' => $request->komentar_text,
    //         'komentar_gambar' => '-',  // Gambar default, bisa diubah jika ada upload gambar
    //         'create_by' => Auth::user()->id_user
    //     ]);

    //     // Jika permintaan adalah AJAX
    //     if ($request->ajax()) {
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Komentar berhasil ditambahkan',
    //             'komentar_text' => $komentar->komentar_text,
    //             'user' => [
    //                 'username' => Auth::user()->username
    //             ],
    //             'created_at' => $komentar->created_at->diffForHumans()
    //         ]);
    //     }

    //     // Jika bukan AJAX, redirect ke halaman sebelumnya
    //     return back();
    // }

    // public function show($id)
    // {
    //     $comments = Komentar::where('posting_id', $id)->with('user')->get();
    //     return response()->json(['status' => 'success', 'comments' => $comments]);
    // }


    // public function store(Request $request, $id)
    // {
    //     $request->validate([
    //         'komentar_text' => 'required|string|max:255',
    //     ]);

    //     $post = Komentar::findOrFail($id);

    //     $comment = new Komentar();
    //     $comment->posting_id = $post->id;
    //     $comment->user_id =  Auth::user()->id_user;
    //     $comment->komentar_text = $request->komentar_text;
    //     $comment->save();

    //     return response()->json(['status' => 'success', 'comment' => $comment]);
    // }


    //     public function store(Request $request, $postingId)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'komentar_text' => 'required|string|max:255',
    //     ]);

    //     // Simpan komentar
    //     $komentar = new Komentar();
    //     $komentar->posting_id = $postingId;
    //     $komentar->id_user = Auth::user()->id_user;// Pastikan Anda memiliki user yang sedang login
    //     $komentar->komentar_text = $request->komentar_text;
    //     $komentar->create_by = Auth::user()->id_user;
    //     $komentar->save();

    //     // Ambil semua komentar setelah ditambahkan
    //     $comments = Komentar::with('user')->where('posting_id', $postingId)->get();

    //     return response()->json([
    //         'status' => true,
    //         'comments' => $comments,
    //     ]);
    // }

}
