<?php

namespace  Netflie\StaticMapSystem;

use Netflie\StaticMapSystem\Entity\MapType;
use Netflie\StaticMapSystem\Exception\MappedTypesNotImplemented;
use Netflie\StaticMapSystem\Exception\BadMappedMapTypeException;
use Netflie\StaticMapSystem\Exception\MapTypeNotFoundException;

trait MapTypeTrait
{
    public function getMapTypes()
    {
        return [
            MapType::ROADMAP_TYPE,
            MapType::SATELLITE_TYPE,
            MapType::HYBRID_TYPE,
            MapType::TERRAIN_TYPE,
        ];
    }

    public function mapTypeExists($mapType)
    {
        return in_array($mapType, $this->getMapTypes());
    }

    public function assertMapTypeExists($mapType)
    {
        if (!$this->mapTypeExists($mapType)) {
            throw new MapTypeNotFoundException($mapType);
        }
    }

    public function getMappedTypes()
    {
        throw new MappedTypesNotImplemented;
    }

    public function getMappedTypeValue($mapType)
    {
        if (!$this->hasMappedTypeValue($mapType)) {
            throw new BadMappedMapTypeException($mapType);
        }

        return $this->getMappedTypes()[$mapType];
    }

    private function hasMappedTypeValue($mapType)
    {
        return array_key_exists($mapType, $this->getMappedTypes());
    }
}