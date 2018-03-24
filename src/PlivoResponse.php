<?php

namespace Mateusjatenee\Plivo;

use Mateusjatenee\Plivo\PlivoMessage;

class PlivoResponse
{
    /**
     * @var \Mateusjatenee\Plivo\PlivoMessage
     */
    public $message;

    /**
     * @var array
     */
    public $response;

    /**
     * @var string
     */
    public $uuid;

    /**
     * @var string
     */
    public $apiId;

    /**
     * @param \Mateusjatenee\Plivo\PlivoMessage $message
     * @param array $response
     */
    public function __construct(PlivoMessage $message, array $response)
    {
        $this->message = $message;
        $this->response = $response;
        $this->populateProperties();
    }

    /**
     * @param \Mateusjatenee\Plivo\PlivoMessage $message
     * @param array $response
     */
    public static function make($message, $response)
    {
        return new static($message, $response);
    }

    protected function populateProperties()
    {
        $this->uuid = $this->response['message_uuid'][0];
        $this->apiId = $this->response['api_id'];
    }
}
