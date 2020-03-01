<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Auth;

/**
 * Class MessagesController
 * @package App\Http\Controllers
 */
class MessagesController extends Controller
{
    /**
     * @var MessageRepository
     */
    protected $message;

    /**
     * MessagesController constructor.
     * @param $message
     */
    public function __construct(MessageRepository $message)
    {
        $this->message = $message;
    }

    /**
     * @return JsonResponse
     */
    public function store()
    {
        $message = $this->message->create([
            'to_user_id'   => '2',
            'from_user_id' => '1',
            'body'         => request('body'),
        ]);
        if($message) {
            return response()->json(['status' => true]);
        }
        return response()->json(['status' => false]);
    }
}
