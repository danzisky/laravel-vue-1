<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Http\Resources\QuestionResource;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionResource::collection(Question::all());
    }

    public function deductPersonality(Request $request) {
        // dd($request->testResponse);
        define('maxAnswerRank', 4);
        define('minAnswerRank', 1);
        $testResponse = collect($request->testResponse) ?? [];

        $extrovertScore = 0;
        $introvertScore = 0;

        // simplest way, find aveeragee of the ranks. But can be inaccurate, depending on anchor rank
        // $responseRanks = array_column($testResponse, 'rank');
        $totalQuestions = 0;
        $totalScore = 0;
        $totalScoreInt = 0;
        foreach ($testResponse as $response) {
            // given the answers are for evenly increasing levels of personality difference from one extreme to the other

            // using extrovertedness as reference
            // $response['answer_rank']--;
            $responseRank = $response['answer_rank'] - 1;
            $totalScore += ($response['peak_personality'] == "extrovert" ? $responseRank : 3 - $responseRank)/3 *4;
            $totalScoreInt += ($response['peak_personality'] == "extrovert" ? 3 - $responseRank : $responseRank)/3 * 4;

            $totalQuestions++;
        }

        $extrovertedness = $totalScore/($totalQuestions * 4);
        $introvertedness = $totalScoreInt/($totalQuestions * 4);
        
        $netScore = $extrovertedness - $introvertedness;
        
        $introvertScore = $introvertedness;
        $extrovertScore = $extrovertedness;

        $personalityResponse = [
            'netScore' => $netScore,
            'totalQuestions' => $totalQuestions,
            'totalScoreInt' => $totalScoreInt,
            'totalScore' => $totalScore,
            'extrovertedness' => $extrovertedness,
            'introvertedness' => $introvertedness,
            'introvertScore' => $introvertScore,
            'extrovertScore' => $extrovertScore,
        ];
        $personalityResponse = collect($personalityResponse);
        return $personalityResponse->toJson();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        // return new QuestionResource(Question::findOrFail($id));
        return new QuestionResource($question);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQuestionRequest  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        //
    }
}
