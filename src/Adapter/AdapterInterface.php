<?php

namespace Netflie\StaticMapSystem\Adapter;

interface AdapterInterface
{
    public function setCenter(string $center): bool;

    public function setSize(int $width, int $height): bool;

    public function getWidth(): int;

    public function getHeight(): int;

    public function setZoom(int $zoom): bool;

    public function setMapType(string $mapType): bool;

    public function setFormat(string $format): bool;

    public function addMarker(string $marker): bool;

    public function getUri(): string;
}