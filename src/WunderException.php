<?php

namespace lfischer\wunderground;

/**
 * Wunder exception.
 *
 * @author Stefano Borghi <https://github.com/stebogit>
 */
class WunderException extends \ErrorException
{
    /**
     * WunderException constructor.
     *
     * @param string               $message
     * @param int                  $code
     * @param \ErrorException|null $previous
     */
    public function __construct($message = null, $code = 0, \ErrorException $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}