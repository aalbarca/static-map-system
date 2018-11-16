<?php

namespace Netflie\StaticMapSystem;

use Netflie\StaticMapSystem\Adapter\AdapterInterface;

class StaticMapSystem implements StaticMapSystemInterface
{
    use MapTypeTrait;
    use FormatTrait;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

    public function setCenter(string $center): bool
    {
        return $this->getAdapter()->setCenter($center);
    }

    public function setSize(int $width, int $height): bool
    {
        return $this->getAdapter()->setSize($width, $height);
    }

    public function setZoom(int $zoom): bool
    {
        return $this->getAdapter()->setZoom($zoom);
    }

    public function setMapType(string $mapType): bool
    {
        $this->assertMapTypeExists($mapType);

        return $this->getAdapter()->setMapType($mapType);
    }

    public function setFormat(string $format)
    {
        $this->assertFormatExists($format);

        return $this->getAdapter()->setFormat($format);
    }

    public function addMarker(string $marker)
    {
        return $this->getAdapter()->addMarker($marker);
    }

    public function getImgTag($options = []): string
    {
        $defaultOptions = [
            'width' => $this->getAdapter()->getWidth(),
            'height' => $this->getAdapter()->getHeight(),
        ];

        $protectedOptions = [
            'src' => $this->getAdapter()->getUri(),
        ];

        $options = array_merge($defaultOptions, $options, $protectedOptions);

        $tag = '<img';

        if (count($options)) {
            foreach ($options as $attribute => $value) {
                $tag .= " $attribute=\"$value\"";
            }
        }

        $tag .= ' >';

        return $tag;
    }
} 