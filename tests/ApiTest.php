<?php

namespace lfischer\wunderground\tests;


class ApiTest extends BaseTest
{
	protected $API;


	public function setUp ()
	{
		parent::setUp();
		$this->API = $this->createMockApiReturningData();
	}


	public function testGetByPWSId ()
	{
		$this->API->getByPWSId('KCASANFR70');
		$this->assertEquals(
			self::API_URL . 'conditions/lang:EN/q/pws:KCASANFR70.json',
			$this->API->getLastQuery()
		);
	}


	public function testGetByAirportCode ()
	{
		$this->API->getByAirportCode('KJFK');
		$this->assertEquals(
			self::API_URL . 'conditions/lang:EN/q/KJFK.json',
			$this->API->getLastQuery()
		);
	}


	public function testGetByCoordinates ()
	{
		$this->API->getByCoordinates(37.8, -122.4);
		$this->assertEquals(
			self::API_URL . 'conditions/lang:EN/q/37.8,-122.4.json',
			$this->API->getLastQuery()
		);
	}


	public function testGetByLocation ()
	{
		$this->API->getByLocation('Australia', 'Sydney');
		$this->assertEquals(
			self::API_URL . 'conditions/lang:EN/q/Australia/Sydney.json',
			$this->API->getLastQuery()
		);
	}


	public function testGetByUSZipcode ()
	{
		$this->API->getByUSZipcode('60290');
		$this->assertEquals(
			self::API_URL . 'conditions/lang:EN/q/60290.json',
			$this->API->getLastQuery()
		);
	}

	public function testGetByUSCity ()
	{
		$this->API->getByUSCity('CA', 'San Francisco');
		$this->assertEquals(
			self::API_URL . 'conditions/lang:EN/q/CA/San_Francisco.json',
			$this->API->getLastQuery()
		);
	}

	public function testGetForecast ()
	{
		$this->API->getForecast('37.8,-122.4');
		$this->assertEquals(
			self::API_URL . 'forecast/hourly/lang:EN/q/37.8,-122.4.json',
			$this->API->getLastQuery()
		);
	}


	public function testGetExtendedForecast ()
	{
		$this->API->getExtendedForecast('WA/Seattle');
		$this->assertEquals(
			self::API_URL . 'forecast10day/hourly10day/lang:EN/q/WA/Seattle.json',
			$this->API->getLastQuery()
		);
	}


	public function testGetHistoric ()
	{
		$this->API->getHistoric('2017-11-23', 'WA/Seattle');
		$this->assertEquals(
			self::API_URL . 'history_20171123/lang:EN/q/WA/Seattle.json',
			$this->API->getLastQuery()
		);
	}

}

