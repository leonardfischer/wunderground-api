<?php

namespace lfischer\wunderground;

/**
 * Basic Weather API class to execute predefined requests.
 *
 * @author Leonard Fischer <post@leonard.fischer.de>
 */
class API extends Request
{
	/**
	 * Retrieves weather data by a (API internal) "city ID".
	 *
	 * @param string $id
	 * @return array
	 */
	public function getByPWSId ($id)
	{
		return $this->fetch(['query' => 'pws:' . $id])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by a (API internal) "city ID".
	 *
	 * @param string $code
	 * @return array
	 */
	public function getByAirportCode ($code)
	{
		return $this->fetch(['query' => $code])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by given coordinates.
	 *
	 * @param float $lat
	 * @param float $lng
	 * @return array
	 */
	public function getByCoordinates ($lat, $lng)
	{
		return $this->fetch(['query' => $lat . ',' . $lng])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by given coordinates.
	 *
	 * @param string $city
	 * @param string $country
	 * @return array
	 */
	public function getByLocation ($city, $country)
	{
		return $this->fetch(['query' => $country . '/' . $city])->getResponseArray();
	} // function
} // class