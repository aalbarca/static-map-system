<?php

namespace Netflie\StaticMapSystem\Adapter;

interface MapTypeInterface
{
	const ROADMAP_TYPE = 'roadmap';
    const SATELLITE_TYPE = 'satellite';
    const HYBRID_TYPE = 'hybrid';
    const TERRAIN_TYPE = 'terrain';
}