<?php


namespace App\Http\Controllers;


use App\Message;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        // assume message is mandatory
        if (empty($message = $request->get('message'))) {
            return $this->apiResponse(Response::HTTP_BAD_REQUEST, null, 'Message is required.');
        }

        return $this->apiResponse(Response::HTTP_CREATED, $request->only('message'));
    }

    public function index(Request $request)
    {
        // max message to retrieve
        $limit = $request->get('limit', Message::MAX_PERPAGE);

        $messages = [];
        $messageModel = new Message();
        for ($i = 0; $i < $limit; $i++) {
            $messages[] = $messageModel->fake();
        }
        return $this->apiResponse(Response::HTTP_OK, $messages);
    }
}
