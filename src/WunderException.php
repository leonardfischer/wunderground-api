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
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}