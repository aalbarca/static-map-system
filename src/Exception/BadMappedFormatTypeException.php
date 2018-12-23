<?php

namespace  Netflie\StaticMapSystem\Exception;

class BadMappedFormatTypeException extends \Exception
{
    public function __construct($format, $code = 0, \Exception $previous = null)
    {
        $message = "The map format '$format' has not a mapped value.";
        parent::__construct($message, $code, $previous);
    }
}