<?php


namespace Message;


use App\Message;
use Symfony\Component\HttpFoundation\Response;
use TestCase;

class StreamMessageTest extends TestCase
{
    protected $path = '/messages/stream';
    public function testSuccess()
    {
        $this->get($this->path)
            ->assertResponseStatus(Response::HTTP_OK);
    }
}
