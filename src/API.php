<?php

namespace lfischer\wunderground;

/**
 * Basic Weather API class to execute predefined requests.
 * see {@link https://www.wunderground.com/weather/api/d/docs?d=data/index&MR=1 Weather Underground docs}
 * for more information.
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
	 * @param string|int $zipcode
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByUSZipcode ($zipcode)
	{
		return $this->fetch(['query' => $zipcode])->getResponseArray();
	} // function


	/**
	 * Retrieves weather data by a given country and city name.
	 *
	 * @param string $state
	 * @param string $city
	 * @return array
	 * @throws \ErrorException
	 */
	public function getByUSCity ($state, $city)
	{
		$c = str_replace(' ', '_', $city);
		return $this->fetch(['query' => $state . '/' . $c])->getResponseArray();
	} // function


	/**
	 * Retrieves hourly and daily weather forecast data by a given location (country+city, coordinates,
	 * zipcode, etc) for the next three days (daily records) or 36 hours (hourly records).
	 * Daily records will include today, hourly records will include the current hour.
	 *
	 * @param string $location any valid Country/City, Lat,Lon, Airport code, etc.
	 * @return array
	 * @throws \ErrorException
	 */
	public function getForecast ($location)
	{
		return $this->setFeatures(['forecast', 'hourly'])->setQuery($location)->fetch()->getResponseArray();
	} // function


	/**
	 * Retrieves hourly and daily weather forecast data by a given
	 * location (country+city, coordinates, zipcode, etc) for the next 10 days.
	 * Daily records will include today, hourly records will include the current hour.
	 *
	 * @param string $location Country/City, Lat,Lon, Airport code, etc.
	 * @return array
	 * @throws \ErrorException
	 */
	public function getExtendedForecast ($location)
	{
		return $this->setFeatures(['forecast10day', 'hourly10day'])->setQuery($location)->fetch()->getResponseArray();
	} // function


	/**
	 * Retrieves observed weather records and the daily summary for the specified date.
	 *
	 * @param string $date any valid {@link http://php.net/manual/en/datetime.formats.date.php Date Formats} format
	 * @param string $location Country/City, Lat,Lon, Airport code, etc.
	 * @return array
	 * @throws \ErrorException
	 */
	public function getHistoric ($date, $location)
	{
		$d = date('Ymd', strtotime($date));

		return $this->setFeature("history_$d")->setQuery($location)->fetch()->getResponseArray();
	} // function


} // class