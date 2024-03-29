<?php
namespace App\Http\Controllers;
use App\Models\Question;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources;
use App\Http\Resources\QuestionResource;
use Illuminate\Support\Facades\Redis;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    public function __construct()
    {
        $this->middleware('JWT', ['except' => ['index','show','createuser']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Question::all();
        // if ($questions = Redis::get('questions.all')) {
        //     return QuestionResource::collection($questions);
        // }
        // $questions = Question::latest()->get();
        // Redis::set('questions.all',$questions);
        return QuestionResource::collection(Question::latest()->get());
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        // $question = new Question();
        // $question->title = $request->input('title');
        // $question->slug = $request->input('slug');
        // $question->body = $request->input('body');
        // $question->category_id = $request->input('category_id');
        // $question->user_id = $request->input('user_id');
        // $question->save();
        $question = auth()->user()->questions()->create($request->all());
        // Question::create($request->all());
        return response(new QuestionResource($question),Response::HTTP_CREATED);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // return Question::find($question);
        return new QuestionResource($question);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->all());
        return response('Updated',Response::HTTP_ACCEPTED);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // return Question::find($id)->delete();
        $question->delete(); 
        // return response('Deleted',201);
        return response(null,Response::HTTP_NO_CONTENT);
    }

    public function createuser(QuestionRequest $request){
        $request['password'] = Hash::make($request->input('password'));
        User::create($request->all());
        return response('created',Response::HTTP_CREATED);
    }
}