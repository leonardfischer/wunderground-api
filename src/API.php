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
	 * Retrieves weather data by a weather station ID.
	 * See https://www.wunderground.com/wundermap/ for more information
	 *
	 * @param string $id
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByPWSId ($id)
	{
		return $this->fetch(['query' => 'pws:' . $id])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by a airport code.
	 *
	 * @param string $code
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByAirportCode ($code)
	{
		return $this->fetch(['query' => $code])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by geo coordinates.
	 *
	 * @param float $lat
	 * @param float $lng
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByCoordinates ($lat, $lng)
	{
		return $this->fetch(['query' => $lat . ',' . $lng])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by a given country and city name.
	 *
	 * @param string $country
	 * @param string $city
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByLocation ($country, $city)
	{
		return $this->fetch(['query' => $country . '/' . $city])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by a given country and city name.
	 *
	 * @param string $zipcode
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByUSZipcode ($zipcode)
	{
		return $this->fetch(['query' => $zipcode])->getResponseArray();
	} // function
} // class