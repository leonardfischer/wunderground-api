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
	protected $features = 'conditions';

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
	protected $lastQuery = null;

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
	 * @param string|array $features
	 * @return $this
	 */
	public function setFeature ($features)
	{
		$this->setFeatures([$features]);

		return $this;
	} // function


	/**
	 * Set multiple API features. Available features:
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
	 * @param array $features
	 * @return $this
	 */
	public function setFeatures ($features)
	{
		$this->features = implode('/', $features);

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
		if (isset($parameters['features'])) {
			$this->setFeature($parameters['features']);
		} // if

		if (isset($parameters['settings'])) {
			$this->setSettings($parameters['settings']);
		} // if

		if (isset($parameters['query'])) {
			$this->setQuery($parameters['query']);
		} // if

		$url = strtr(self::URL, [
			':apiKey' => $this->apiKey,
			':features' => $this->features,
			':settings' => $this->settings,
			':query' => $this->query,
		]);

		$this->lastQuery = $url;

		$this->responseJSON = $this->request($url);
		$this->responseArray = json_decode($this->responseJSON, true);

		if (!is_array($this->responseArray)) {
			throw new \ErrorException('The Weather Underground API response returned no valid JSON: ' . $this->responseJSON);
		} // if

		if (!isset($this->responseArray['response'])) {
			throw new \ErrorException('The Weather Underground API response is not set or empty: ' . $this->responseJSON);
		} // if

		if (isset($this->responseArray['response']) && isset($this->responseArray['response']['error'])) {
			throw new \ErrorException('The Weather Underground API responded with errors: ' . var_export($this->responseArray['response']['error'],
					true));
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


	/**
	 * Method for getting the data from the API.
	 *
	 * @param $url
	 * @return string
	 */
	protected function request ($url)
	{
		return @file_get_contents($url);
	} // function


	/**
	 * Method for getting the last called query.
	 *
	 * @return string
	 */
	public function getLastQuery ()
	{
		return $this->lastQuery;
	} // function


} // class