<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Http\Resources\QuestionResource;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class AppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function questions()
    {
        return QuestionResource::collection(Question::all());
    }

    public function deducePersonality(Request $request) {
        // dd($request->testResponse);
        // define('maxAnswerRank', 4);
        // define('minAnswerRank', 1);
        $testResponse = collect($request->testResponse) ?? [];

        if(empty($testResponse)) {
            return Response::denyWithStatus(404);
        }

        $extrovertScore = 0;
        $introvertScore = 0;

        // simplest way, find aveeragee of the ranks. But can be inaccurate, depending on anchor rank

        // in the formula below
        // '3' can be substituded for maxAnswerRank - minAnswerRank
        // '1' can be substituded for minAnswerRank
        // '4' can be substituded for maxAnswerRank
        // for a more practical formmula

        $totalQuestions = 0;
        $totalScoreExtrovert = 0;
        $totalScoreIntrovert = 0;
        foreach ($testResponse as $response) {
            // given the answers are for evenly increasing levels of personality difference from one extreme to the other

            // the deduction by 1 is to have the possibility of a zero value to indicate complete absence of the opposite personality
            // the multiplicaion of the ration by 4 is to have it back on the scale

            $responseRank = $response['answer_rank'] - 1;
            $totalScoreExtrovert += ($response['peak_personality'] == "extrovert" ? $responseRank : 3 - $responseRank)/3 *4;
            $totalScoreIntrovert += ($response['peak_personality'] == "extrovert" ? 3 - $responseRank : $responseRank)/3 * 4;

            $totalQuestions++;
        }

        if($totalQuestions == 0) {
            return Response::denyWithStatus(404);
        }

        $extrovertedness = $totalScoreExtrovert/($totalQuestions * 4);
        $introvertedness = $totalScoreIntrovert/($totalQuestions * 4);
        
        $netScore = $extrovertedness - $introvertedness;
        
        $introvertScore = $introvertedness;
        $extrovertScore = $extrovertedness;

        $personalityResponse = [
            'netScore' => round($netScore, 2),
            'totalQuestions' => round($totalQuestions, 2),
            'totalScoreIntrovert' => round($totalScoreIntrovert, 2),
            'totalScoreExtrovert' => round($totalScoreExtrovert, 2),
            'introvertScore' => round($introvertScore, 2),
            'extrovertScore' => round($extrovertScore, 2),
        ];
        $personalityResponse = collect($personalityResponse);
        return $personalityResponse->toJson();
    }
}
