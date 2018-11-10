<?php

namespace Netflie\StaticMapSystem;

class StaticMapSystem implements StaticMapSystemInterface
{
    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function getAdapter(): AdapterInterface
    {
        return $this->adapter;
    }

    public function setCenter(string $center)
    {
        $this->getAdapter()->setCenter($center);
    }

    public function setSize(int $width, int $height)
    {
        $this->getAdapter()->setSize($width, $height);
    }

    public function setZoom(int $zoom)
    {
        $this->getAdapter()->setZoom($zoom);
    }

    public function setMapType(string $mapType)
    {
        $this->getAdapter()->setMapType($mapType);
    }

    public function setFormat(string $format)
    {
        $this->getAdapter()->setFormat($format);
    }

    public function addMarker(string $marker)
    {
        $this->getAdapter()->addMarker($marker);
    }

    public function getImgTag($options): string
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