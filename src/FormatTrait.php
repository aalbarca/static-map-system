<?php

namespace  Netflie\StaticMapSystem;

use Netflie\StaticMapSystem\Entity\Format as MapFormat;
use Netflie\StaticMapSystem\Exception\FormatNotFoundException;

trait FormatTrait
{
    public function getFormats()
    {
        return [
            MapFormat::PNG,
            MapFormat::JPEG,
        ];
    }

    public function assertFormatExists($format)
    {
        if (!$this->formatExists($format)) {
            throw new FormatNotFoundException($format);
        }
    }

    public function formatExists($format)
    {
        return in_array($format, $this->getFormats());
    }
}