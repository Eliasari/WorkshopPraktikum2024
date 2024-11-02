<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Likes;
use App\Models\Posting;
use Illuminate\Support\Facades\Auth;

class ApiLikeController extends Controller
{
    public function store(Request $request, Posting $posting)
    {
        $request->validate([
            'id_user' => 'required|integer',
        ]);

        $like = Likes::create([
            'posting_id' => $posting->id,
            'id_user' => Auth::user()->id_user, 
            'create_by' => Auth::user()->id_user,
            'create_date' => now(),
        ]);

        return response()->json($like, 201);
    }

    public function destroy(Posting $posting, Likes $like)
    {
        $like->delete();
        return response()->json(null, 204);
    }
}
