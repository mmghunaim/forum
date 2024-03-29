<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\ReplyResource;
use App\Notifications\NewReplyNotification;
use App\Events\DeleteReplyEvent;

class ReplyController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
        // return Reply::latest()->get();
    }

    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());

        $user = $question->user;
        if ($question->user_id !== $reply->user_id) {
            $user->notify(new NewReplyNotification($reply));
        }
        return response(['reply' => new ReplyResource($reply)],Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question , Reply $reply)
    {
        return new ReplyResource($reply);
    }

    public function update(Question $question, Request $request, Reply $reply)
    {
        $reply->update($request->all());

        return response('updated',Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        broadcast(new DeleteReplyEvent($reply->id))->toOthers();
        return response(null,Response::HTTP_NO_CONTENT);
    }
}
