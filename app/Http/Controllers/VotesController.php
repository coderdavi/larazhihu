<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class VotesController
 * @package App\Http\Controllers
 */
class VotesController extends Controller
{
    /**
     * @var AnswerRepository
     */
    protected $answer;

    /**
     * VotesController constructor.
     * @param $answer
     */
    public function __construct(AnswerRepository $answer)
    {
        $this->answer = $answer;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function users($id)
    {
        if(user('api')->hasVotedFor($id)) {
            return response()->json(['voted' => true]);
        }

        return response()->json(['voted' => false]);

    }

    /**
     * @return JsonResponse
     */
    public function vote()
    {
        $answer = $this->answer->byId(request('answer'));
        $voted = user('api')->voteFor(request('answer'));

        if (count($voted['attached']) > 0) {
            $answer->increment('votes_count');

            return response()->json(['voted' => true]);
        }

        $answer->decrement('votes_count');

        return response()->json(['voted' => false]);
    }
}
