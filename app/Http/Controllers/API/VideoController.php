<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Video;
use App\Traits\UserTrait;

class VideoController extends Controller
{
    use UserTrait;

    public function storeComment(Request $request, Video $video)
    {
        $user = $this->getUserFromRequest($request);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $comment = new Comment();
        $comment->video_id = $video->id;
        $comment->user_id = $user->id;
        $comment->content = $request->content;
        $comment->save();

        return response()->json(['message' => 'Comment added successfully']);
    }

    public function like(Request $request, Video $video)
    {
        $user = $this->getUserFromRequest($request);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $video->usersWhoLiked()->toggle($user->id);

        return response()->json(['message' => 'Like toggled successfully']);
    }
}
