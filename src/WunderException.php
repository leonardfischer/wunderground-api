<?php

namespace lfischer\wunderground;


class WunderException extends \ErrorException
{

	public function __construct ($message = null, $code = 0, \ErrorException $previous = null)
	{
		parent::__construct($message, $code, $previous);
	}

}