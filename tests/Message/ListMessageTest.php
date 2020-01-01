<?php


namespace Message;

namespace Message;

use App\Message;
use Symfony\Component\HttpFoundation\Response;
use TestCase;

class ListMessageTest extends TestCase
{
    private $path = '/messages';

    public function setUp(): void
    {
        parent::setUp();
        // add specific data structure on response
        $this->apiResponseStructure['data'] = ['*' => ['id', 'message', 'created_at']];

    }

    public function testSuccess()
    {
        $this->get($this->path)
            ->seeJsonStructure($this->apiResponseStructure)
            ->seeJson([
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK],
            ])
            ->assertResponseStatus(Response::HTTP_OK);
        $this->assertCount(Message::MAX_PERPAGE, $this->response->original['data']);
    }

    public function testSuccessOnDefinedLimit()
    {
        $limitPerPage = 5;

        $this->get($this->path.'?'.http_build_query(['limit' => $limitPerPage]))
            ->seeJsonStructure($this->apiResponseStructure)
            ->seeJson([
                'code' => Response::HTTP_OK,
                'message' => Response::$statusTexts[Response::HTTP_OK],
            ])
            ->assertResponseStatus(Response::HTTP_OK);
        $this->assertCount($limitPerPage, $this->response->original['data']);
    }
}
