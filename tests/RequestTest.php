<?php

namespace lfischer\wunderground\tests;


use lfischer\wunderground\Request;

class RequestTest extends BaseTest
{
	protected $Request;
	protected $response;


	public function setUp ()
	{
		parent::setUp();
		$this->response = file_get_contents(__DIR__ . '/response.json');
		$this->Request = $this->createStub(Request::class, 'request', $this->response);
	}


	public function testShouldReturnArray ()
	{
		$result = $this->Request->fetch(['query' => 'KJFK'])->getResponseArray();
		$this->assertTrue(is_array($result));
	}


	public function testShouldReturnJson ()
	{
		$result = $this->Request->fetch(['query' => 'KJFK'])->getResponseJSON();
		$this->assertEquals($this->response, $result);
	}


	public function testShouldReturnObject ()
	{
		$result = $this->Request->fetch(['query' => 'KJFK'])->getResponseObject();
		$this->assertEquals(json_decode($this->response), $result);
	}

}
