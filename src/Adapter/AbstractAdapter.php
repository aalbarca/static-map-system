<?php

namespace Netflie\StaticMapSystem\Adapter;

use Netflie\StaticMapSystem\MapTypeTrait;
use Netflie\StaticMapSystem\FormatTrait;

abstract class AbstractAdapter implements AdapterInterface
{
    use MapTypeTrait;
    use FormatTrait;
}