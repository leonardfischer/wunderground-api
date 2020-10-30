<?php

namespace lfischer\wunderground\tests;

use lfischer\wunderground\API;
use lfischer\wunderground\WunderException;

class ApiExceptionTest extends BaseTest
{
    protected $API;

    public function testShouldThrowExceptionOnError()
    {
        $this->API = $this->createStub(API::class, 'request', '{"response": {"error": "something went wrong"}}');

        $this->expectException(WunderException::class);
        $this->API->getByUSCity('CA', 'San Francisco');
    }

    public function testShouldThrowExceptionOnInvalidJson()
    {
        $this->API = $this->createStub(API::class, 'request', 'response is not JSON.');

        $this->expectException(WunderException::class);
        $this->API->getForecast('CA/San_Francisco');
    }

    public function testShouldThrowExceptionOnMissingResponse()
    {
        $this->API = $this->createStub(API::class, 'request', '{"status": "OK"}');

        $this->expectException(WunderException::class);
        $this->API->getExtendedForecast('CO/Denver');
    }
}

