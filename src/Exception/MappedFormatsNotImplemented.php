<?php

namespace  Netflie\StaticMapSystem\Exception;

class MappedFormatsNotImplemented extends \Exception
{
    protected const MESSAGE = 'Adapter has to implement its own mapped formats. Check the doc to more information.';

    public function __construct($code = 0, \Exception $previous = null)
    {
        parent::__construct(static::MESSAGE, $code, $previous);
    }
}