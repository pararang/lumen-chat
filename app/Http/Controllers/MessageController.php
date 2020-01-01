<?php


namespace App\Http\Controllers;


use App\Events\MessageEvent;
use App\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use function foo\func;

class MessageController extends Controller
{
    /**
     * store/send message
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * param on request: string message required
     */
    public function store(Request $request)
    {
        // assume message is mandatory
        if (empty($message = $request->get('message'))) {
            return $this->apiResponse(Response::HTTP_BAD_REQUEST, null, 'Message is required.');
        }
        event(new MessageEvent($message, Carbon::now()->format('Y-m-d H:i:s')));
        return $this->apiResponse(Response::HTTP_CREATED, $request->only('message'));
    }

    /**
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * param on request: int limit optional
     */
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

    public function stream()
    {
        $messageModel = new Message();
        $message = $messageModel->fake();
        $response = new StreamedResponse();
        $response->setCallback(function () use ($message) {
//            echo 'data: ' . json_encode($message) . "\n\n";
//            echo "retry: 100\n\n"; // no retry would default to 3 seconds.
            ob_flush();
            flush();
            usleep(200000);
        });
        $response->headers->set('Content-Type', 'text/event-stream');
        $response->headers->set('X-Accel-Buffering', 'no');
        $response->headers->set('Cach-Control', 'no-cache');
        $response->send();
    }
}
