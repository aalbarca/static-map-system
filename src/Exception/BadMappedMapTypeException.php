<?php

namespace  Netflie\StaticMapSystem\Exception;

class BadMappedMapTypeException extends \Exception
{
    public function __construct($mapType, $code = 0, \Exception $previous = null)
    {
        $message = "The map type '$mapType' has not a mapped value.";
        parent::__construct($message, $code, $previous);
    }
}