<?php

namespace Netflie\StaticMapSystem\Adapter;

abstract class AbstractAdapter implements AdapterInterface
{
    protected $mapTypes = [
        AdapterInterface::ROADMAP_TYPE => 'roadmap',
        AdapterInterface::SATELLITE_TYPE => 'satellite',
        AdapterInterface::HYBRID_TYPE => 'hybrid',
        AdapterInterface::TERRAIN_TYPE => 'terrain',
    ];

    protected $formats = [
        AdapterInterface::JPEG_FORMAT => 'jpeg',
        AdapterInterface::PNG_FORMAT => 'png',
    ];

    protected function getMappedMapType($mapType)
    {
        if (!array_key_exists($mapType, $mapTypes)) {
            throw new BadMapTypeException("The map type '$mapType' value is wrong");
        }

        return $this->mapTypes[$mapType];
    }

    protected function getMappedFormat($format)
    {
        if (!array_key_exists($format, $formats)) {
            throw new BadMapTypeException("The format '$format' value is wrong");
        }

        return $this->formats[$format];
    }
}