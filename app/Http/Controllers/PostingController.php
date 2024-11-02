<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posting;
use App\Models\User;
use App\Models\Komentar;
use Illuminate\Support\Facades\Auth;

class PostingController extends Controller
{
    public function index()
    {
        $posts = Posting::with('senderBy')->latest()->get()->map(function ($post) {
            $post->liked = $post->likes->where('id_user', Auth::user()->id_user)->isNotEmpty();
            return $post;
        });

        return view('management.indexPostingan', compact('posts'));
    }

    public function create()
    {
        return view('management.createPostingan');
    }

    public function store(Request $request)
    {
        if ($request->has('message_gambar')) {
            $image = $request->file('message_gambar');
            $imagePath = $image->store('uploads', 'public');

            Posting::create([
                'sender' => Auth::user()->id_user,
                'message_text' => $request->message_text,
                'message_gambar' => $imagePath,
                'create_by' => Auth::user()->id_user,
            ]);

            return redirect()->route('postings.index')->with('Success', 'berhasil terposting');
        }

        Posting::create([
            'sender' => Auth::user()->id_user,
            'message_text' => $request->message_text,
            'messgae_gambar' => '-',
            'create_by' => Auth::user()->id_user,
        ]);

        return redirect()->route('postings.index')->with('Success', 'berhasil terposting');
    }

    public function show($id)
    {
        $post = Posting::with('senderBy', 'komentar.user')->findOrFail($id);
        $comments = Komentar::with('user')
            ->where('posting_id', '=', $post->posting_id)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('postings.show', compact('post', 'comments'));
    }
    
    public function destroy($id)
    {
        $posting = Posting::findOrFail($id);
        $posting->delete();

        return redirect()->route('postings.index')->with('success', 'Postingan berhasil dihapus!');
    }
}
