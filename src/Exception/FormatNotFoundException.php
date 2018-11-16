<?php

namespace  Netflie\StaticMapSystem\Exception;

class FormatNotFoundException extends \Exception
{
    public function __construct($format, $code = 0, \Exception $previous = null)
    {
        $message = "Format '$format' not found.";
        parent::__construct($message, $code, $previous);
    }
}