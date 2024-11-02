<?php

namespace App\Http\Controllers;

use App\Models\Posting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Likes;

class LikeController extends Controller
{
    public function like($postingId)   {
        $post = Posting::findOrFail($postingId);
        $userId = Auth::user()->id_user;

        $like = Likes::where('posting_id', $post->posting_id)->where('id_user', $userId)->first();

        if (!$like) {
            $like = new Likes();
            $like->posting_id = $postingId;
            $like->id_user = $userId;
            $like->create_by = $userId;
            $like->save();

            return response()->json(['message' => 'Liked', 'status' => true, 'like_id' => $like->like_id]);
        }

        return response()->json(['message' => 'Already liked', 'status' => false]);
    }

    public function dislike($postingId, $likeId) {
        $userId = Auth::user()->id_user;

        $like = Likes::where('posting_id', $postingId)
                      ->where('id_user', $userId)
                      ->where('like_id', $likeId)
                      ->first();

        if ($like) {
            $like->delete();
            return response()->json(['message' => 'Unliked', 'status' => true, 'like_id' => $likeId]);
        }

        return response()->json(['message' => 'Not found', 'status' => false]);
    }

}
