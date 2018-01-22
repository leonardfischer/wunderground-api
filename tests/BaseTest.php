<?php

namespace lfischer\wunderground\tests;


use lfischer\wunderground\API;
use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
	const API_URL = 'http://api.wunderground.com/api/some-key/';
	const KEY = 'some-key';


	protected function createMockAPI ($method = 'request')
	{
		return $this->getMockBuilder(API::class)
			->setConstructorArgs([self::KEY])
			->setMethods([$method])
			->getMock();
	}


	protected function createMockApiReturningData ($returnedData = '{"response": "OK"}')
	{
		$stub = $this->createMockAPI();
		// define what the mocked method should return when called
		$stub->method('request')->willReturn($returnedData);

		return $stub;
	}


	protected function createMockApiThrowingException ()
	{
		$stub = $this->createMockAPI();
		$stub->method('request')->will($this->throwException(new \ErrorException));

		return $stub;
	}

}
