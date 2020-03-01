<?php

namespace App\Http\Controllers;

use App\Notifications\NewUserFollowNotification;
use App\Respositories\UserRepository;
use Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class FollowersController
 * @package App\Http\Controllers
 */
class FollowersController extends Controller
{

    protected $user;

    /**
     * FollowersController constructor.
     * @param $user
     */
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function index($id)
    {
        $user = $this->user->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();

        if ( in_array(Auth::guard('api')->user()->id, $followers) ) {
            return response()->json(['followed' => true]);
        }

        return response()->json(['followed' => false]);

    }

    /**
     * @return JsonResponse
     */
    public function follow()
    {
        $userToFollow = $this->user->byId(request('user'));

        $followed = Auth::guard('api')->user()->followThisUser($userToFollow->id);
        if ( count($followed['attached']) > 0 ) {
            $userToFollow->increment('followers_count');
            $userToFollow->notify(new NewUserFollowNotification());
            return response()->json(['followed' => true]);
        }

        $userToFollow->decrement('followers_count');

        return response()->json(['followed' => false]);

    }
}
