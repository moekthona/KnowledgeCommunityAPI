<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use App\Http\Resources\Question as QuestionResource;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(QuestionResource::collection(Question::all()), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $q = new Question();
        $q->Title = $request->title;
        $q->Description = $request->description;
        $q->CreatedDateTime = $q->UpdatedDateTime = date('Y-m-d H:i:s');
        $q->Vote = 0;
        $q->AvatarId = $request->avatar_id;
        if ($q->save())
            return response()->json(new QuestionResource($q), 201);
        else
            return response()->json(['message' => 'fail to save the record'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $q = Question::find($id);
        if (is_null($q))
            return response()->json(['message' => 'record is not found'], 404);
        return response()->json(new QuestionResource($q), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        $q = Question::find($id);
        if (is_null($q))
            return response()->json(['message' => 'record is not found'], 404);
        $q->Title = $request->title;
        $q->Description = $request->description;
        $q->UpdatedDateTime = date('Y-m-d H:i:s');
        if ($q->save())
            return response()->json(new QuestionResource($q), 200);
        else
            return response()->json(['message' => 'fail to update the record'], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $q = Question::find($id);
        if (is_null($q))
            return response()->json(['message' => 'record is not found'], 404);
        if($q->delete())
            return response()->json(null, 204);
        else
            return response()->json(['message' => 'fail to delete the record'], 500);
    }

    public function voteUpdate (Request $request, string $id)
    {
        $q = Question::find($id);
        if (is_null($q))
            return response()->json(['message' => 'record is not found'], 404);

        if (abs($request->vote) !== 1)
            return response()->json(['message' => 'value of vote parameter must be either 1 or -1'], 400);
        $q->Vote += $request->vote;
        
        if($q->save())
            return response()->json(new QuestionResource($q), 200);
        else
            return response()->json(['message' => 'fail to update the record'], 500);
    }
}
