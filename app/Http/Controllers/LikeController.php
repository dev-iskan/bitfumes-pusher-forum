<?php

namespace App\Http\Controllers;

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
        return response('Liked', 200);
    }

    public  function unlikeIt (Reply $reply) {
        $reply->like()->where('user_id', auth()->id())->first()->delete();
        return response('Disliked', 201);

    }
}
