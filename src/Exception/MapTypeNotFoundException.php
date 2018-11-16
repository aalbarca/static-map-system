<?php

namespace  Netflie\StaticMapSystem\Exception;

class MapTypeNotFoundException extends \Exception
{
    public function __construct($mapType, $code = 0, \Exception $previous = null)
    {
        $message = "MapType '$mapType' not found.";
        parent::__construct($message, $code, $previous);
    }
}