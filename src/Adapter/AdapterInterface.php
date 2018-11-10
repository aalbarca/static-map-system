<?php

namespace Netflie\StaticMapSystem\Adapter;

interface AdapterInterface extends MapTypeInterface, FormatInterface
{
    public function setCenter(string $center);

    public function setSize(int $width, int $height);

    public function getWidth(): int;

    public function getHeight(): int;

    public function setZoom(int $zoom);

    public function setMapType(string $mapType);

    public function setFormat(string $format);

    public function addMarker(string $marker);

    public function getUri(): string;
}