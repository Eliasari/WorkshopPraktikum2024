<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class ApiPostingController extends Controller
{
    public function index()
    {
        $postings = Posting::with(['senderUser', 'likes', 'komentar'])->get();
        return response()->json($postings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'message_text' => 'required|string',
            'message_gambar' => 'nullable|string',
        ]);


        $posting = Posting::create([
            'sender' => Auth::user()->id_user,
            'message_text' => $request->message_text,
            'message_gambar' => $request->message_gambar,
            'create_by' => Auth::user()->id_user,
            'delete_mark' => '0',
        ]);

        return response()->json($posting, 201);
    }

    public function show($id)
    {
        $posting = Posting::with(['senderUser', 'likes', 'komentar'])->findOrFail($id);
        return response()->json($posting);
    }

    public function update(Request $request, $id)
    {
        $posting = Posting::findOrFail($id);
        $request->validate([
            'message_text' => 'sometimes|required|string',
            'message_gambar' => 'nullable|string',
        ]);

        $posting->update(array_filter($request->all()));
        return response()->json($posting);
    }

    public function destroy($id)
    {
        $posting = Posting::findOrFail($id);
        $posting->delete();

        return response()->json(null, 204);
    }
}
