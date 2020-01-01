<?php


namespace Message;

use Symfony\Component\HttpFoundation\Response;
use TestCase;

class CreateMessageTest extends TestCase
{
    private $path = '/messages';

    public function testErrorOnRequiredMessage()
    {
        $this->post($this->path)
            ->seeJsonStructure($this->apiResponseStructure)
            ->assertResponseStatus(Response::HTTP_BAD_REQUEST);
    }

    public function testSuccess()
    {
        $inputMessage = "This message from test.";
        $this->post($this->path, ['message' => $inputMessage])
            ->seeJsonStructure($this->apiResponseStructure)
            ->seeJson([
                'code' => Response::HTTP_CREATED,
                'message' => Response::$statusTexts[Response::HTTP_CREATED],
                'data' => ['message' => $inputMessage]
            ])
            ->assertResponseStatus(Response::HTTP_CREATED);
    }
}
