<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Reply;
use App\Events\LikeEvent;
class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT');
    }

    public function like(Reply $reply){
        $reply->like()->create([
            'user_id' => auth()->id()
        ]);

        //to fire an event
        // event(new LikeEvent($reply->id,1))
        broadcast(new LikeEvent($reply->id,1))->toOthers();
    }

    public function unLike(Reply $reply){
        $reply->like()->where('user_id',auth()->id())->first()->delete();
        broadcast(new LikeEvent($reply->id,0))->toOthers();
    }
}
