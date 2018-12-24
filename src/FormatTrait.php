<?php

namespace  Netflie\StaticMapSystem;

use Netflie\StaticMapSystem\Entity\Format as MapFormat;
use Netflie\StaticMapSystem\Exception\FormatNotFoundException;
use Netflie\StaticMapSystem\Exception\MappedFormatsNotImplemented;
use Netflie\StaticMapSystem\Exception\BadMappedFormatTypeException;

trait FormatTrait
{
    public function getFormats()
    {
        return [
            MapFormat::PNG,
            MapFormat::JPEG,
        ];
    }

    public function formatExists($format)
    {
        return in_array($format, $this->getFormats());
    }

    public function assertFormatExists($format)
    {
        if (!$this->formatExists($format)) {
            throw new FormatNotFoundException($format);
        }
    }

    public function getMappedFormats()
    {
        throw new MappedFormatsNotImplemented;
    }

    public function getMappedFormatValue($format)
    {
        if (!$this->hasMappedFormatValue($format)) {
            throw new BadMappedFormatTypeException($format);
        }

        return $this->getMappedFormats()[$format];
    }

    private function hasMappedFormatValue($format)
    {
        return array_key_exists($format, $this->getMappedFormats());
    }
}