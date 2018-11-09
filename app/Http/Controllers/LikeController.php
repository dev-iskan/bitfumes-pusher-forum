<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Like;
use App\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt');
    }
    public  function likeIt (Reply $reply) {
        $reply->like()->create([
            'user_id' => auth()->id()
        ]);
        broadcast(new LikeEvent($reply->id, 1))->toOthers(); //1 for like
        return response('Liked', 200);
    }

    public  function unlikeIt (Reply $reply) {
        $reply->like()->where('user_id', auth()->id())->first()->delete();
        broadcast(new LikeEvent($reply->id, 0))->toOthers(); //0 for unlike
        return response('Disliked', 201);

    }
}
