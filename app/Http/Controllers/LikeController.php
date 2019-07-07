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
            'user_id' => '1'
        ]);
    }

    public function unLike(Reply $reply){
        $reply->like()->where('user_id','1')->first()->delete();
    }
}
