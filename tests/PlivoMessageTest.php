<?php

namespace Mateusjatenee\Plivo\Test;

use Mateusjatenee\Plivo\PlivoMessage;
use Mateusjatenee\Plivo\PlivoResponse;

class PlivoMessageTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Mateusjatenee\Plivo\PlivoMessage */
    protected $message;

    /** @test */
    public function setUp()
    {
        parent::setUp();

        $this->message = new PlivoMessage();
    }

    /** @test */
    public function it_can_accept_a_message_when_constructing_a_message()
    {
        $message = new PlivoMessage('myMessage');

        $this->assertEquals('myMessage', $message->content);
    }

    /** @test */
    public function it_can_set_the_content()
    {
        $this->message->content('myMessage');

        $this->assertEquals('myMessage', $this->message->content);
    }

    /** @test */
    public function it_can_set_the_from_number()
    {
        $this->message->from('1234567890');

        $this->assertEquals('1234567890', $this->message->from);
    }

    /** @test */
    public function it_can_set_the_webhook()
    {
        $this->message->webhook('https://example.com');

        $this->assertEquals('https://example.com', $this->message->webhook);
    }

    /** @test */
    public function it_can_add_callbacks()
    {
        $this->assertEquals([], $this->message->getCallbacks());

        $this->message->then(function (PlivoResponse $response) {
            return $response;
        });

        $this->message->fireCallbacks([
            'api_id' => '123654',
            'message_uuid' => ['123'],
        ]);

        $this->assertNotEmpty($this->message->getCallbacks());
    }
}
