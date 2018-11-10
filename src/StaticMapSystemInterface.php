<?php

namespace Netflie\StaticMapSystem;

interface StaticMapSystemInterface
{
    public function setCenter(string $center);

    public function setSize(int $width, int $height);

    public function setZoom(int $zoom);

    public function setMapType(string $mapType);

    public function setFormat(string $format);

    public function addMarker(string $marker);

    public function getImgTag($options): string;
}