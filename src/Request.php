<?php

namespace lfischer\wunderground;

/**
 * API Request class.
 *
 * @author Leonard Fischer <post@leonard.fischer.de>
 */
class Request
{
	const URL = 'http://api.wunderground.com/api/:apiKey/:features/:settings/q/:query.json';

	/**
	 * @var string
	 */
	protected $apiKey = '';

	/**
	 * @var string
	 */
	protected $feature = 'conditions';

	/**
	 * @var string
	 */
	protected $settings = 'lang:EN';

	/**
	 * @var string
	 */
	protected $query = 'CA/San_Francisco';

	/**
	 * @var string
	 */
	protected $responseJSON = null;

	/**
	 * @var array
	 */
	protected $responseArray = null;


	/**
	 * Constructor.
	 *
	 * @param $apiKey
	 */
	public function __construct ($apiKey)
	{
		$this->apiKey = $apiKey;
	} // function


	/**
	 * Set a API feature. Available features:
	 * - alerts
	 * - almanac
	 * - astronomy
	 * - conditions
	 * - currenthurricane
	 * - forecast
	 * - forecast10day
	 * - geolookup
	 * - history
	 * - hourly
	 * - hourly10day
	 * - planner
	 * - rawtide
	 * - tide
	 * - webcams
	 * - yesterday
	 *
	 * @param string $feature
	 * @return $this
	 */
	public function setFeature ($feature)
	{
		$this->feature = $feature;

		return $this;
	} // function


	/**
	 * Set a API setting. Available settings are:
	 * - lang
	 * - pws
	 * - bestfct
	 *
	 * @param string $settings
	 * @return $this
	 */
	public function setSettings ($settings)
	{
		$this->settings = $settings;

		return $this;
	} // function


	/**
	 * Set a API query. Query examples:
	 * - <US state>/<city>
	 * - <US zipcode>/<city>
	 * - <country>/<city>
	 * - <latitude>,<longitude>
	 * - <airport code>
	 * - pws:<PWS id>
	 * - autoip
	 * - autoip.json?geo_ip=<IP address>
	 *
	 * @param string $query
	 * @return $this
	 */
	public function setQuery ($query)
	{
		$this->query = $query;

		return $this;
	} // function


	/**
	 * API fetch method.
	 *
	 * @param array $parameters
	 * @return $this
	 * @throws \ErrorException
	 */
	public function fetch (array $parameters = [])
	{
		if (isset($parameters['features']))
		{
			$this->setFeature($parameters['features']);
		} // if

		if (isset($parameters['settings']))
		{
			$this->setSettings($parameters['settings']);
		} // if

		if (isset($parameters['query']))
		{
			$this->setQuery($parameters['query']);
		} // if

		$url = strtr(self::URL, [
			':apiKey' => $this->apiKey,
			':features' => $this->feature,
			':settings' => $this->settings,
			':query' => $this->query
		]);

		$this->responseJSON = file_get_contents($url);
		$this->responseArray = json_decode($this->responseJSON, true);

		if (!is_array($this->responseArray))
		{
			throw new \ErrorException('The Weather Underground API response returned no valid JSON: ' . $this->responseJSON);
		} // if

		if (!isset($this->responseArray['response']))
		{
			throw new \ErrorException('The Weather Underground API response is not set or empty: ' . $this->responseJSON);
		} // if

		if (isset($this->responseArray['response']) && isset($this->responseArray['response']['error']))
		{
			throw new \ErrorException('The Weather Underground API responded with errors: ' . var_export($this->responseArray['response']['error'], true));
		} // if

		return $this;
	} // function


	/**
	 * Method for returning the raw response.
	 *
	 * @return  string
	 */
	public function getResponseJSON ()
	{
		return $this->responseJSON;
	} // function


	/**
	 * Method for returning the response array.
	 *
	 * @return array
	 */
	public function getResponseArray ()
	{
		return $this->responseArray;
	} // function


	/**
	 * Method for returning the response as object.
	 *
	 * @return \stdClass
	 */
	public function getResponseObject ()
	{
		return json_decode($this->responseJSON);
	} // function
} // class