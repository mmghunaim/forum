<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Reply;
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
    }

    public function unLike(Reply $reply){
        $reply->like()->where('user_id',auth()->id())->first()->delete();
    }
}
