<?php

namespace lfischer\wunderground\tests;


use PHPUnit\Framework\TestCase;

abstract class BaseTest extends TestCase
{
	const API_URL = 'http://api.wunderground.com/api/some-key/';
	const KEY = 'some-key';


	protected function createStub ($class, $method, $returnedData = null)
	{
		$stub = $this->getMockBuilder($class)
			->setConstructorArgs([self::KEY])
			->setMethods([$method])
			->getMock();

		if ($returnedData !== null) {
			$stub->method($method)->willReturn($returnedData);
		}

		return $stub;
	}


}
