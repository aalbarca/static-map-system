<?php

namespace Netflie\StaticMapSystem\Test;

use Netflie\StaticMapSystem\Entity\MapType;
use Netflie\StaticMapSystem\MapTypeTrait;
use Netflie\StaticMapSystem\Exception\MapTypeNotFoundException;
use Netflie\StaticMapSystem\Exception\BadMappedMapTypeException;
use Netflie\StaticMapSystem\Exception\MappedTypesNotImplemented;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class StaticMapSystemTests extends TestCase
{
    /**
     * @var MockObject
     */
    protected $mock;

    /**
     * @before
     */
    public function setupMapTrait()
    {
        $this->mock = $this->getMockForTrait(MapTypeTrait::class, [], '', true, true, true, ['getMappedTypes']);
    }

    public function testGetMapTypes()
    {
        $expected_types = [
            MapType::ROADMAP_TYPE,
            MapType::SATELLITE_TYPE,
            MapType::HYBRID_TYPE,
            MapType::TERRAIN_TYPE,
        ];

        $this->assertArraySubset($expected_types, $this->mock->getMapTypes());
    }

    public function testMapTypeExists()
    {
        $type_1 = MapType::ROADMAP_TYPE;
        $type_2 = MapType::SATELLITE_TYPE;
        $fake_type = 'fake_type';

        $this->assertTrue($this->mock->mapTypeExists($type_1));
        $this->assertTrue($this->mock->mapTypeExists($type_2));
        $this->assertFalse($this->mock->mapTypeExists($fake_type));
    }

    public function testAssertMapTypeExists()
    {
        $fake_type = 'fake_type';

        $this->expectException(MapTypeNotFoundException::class);
        $this->mock->assertMapTypeExists($fake_type);
    }

    public function testGetMappedTypes()
    {
        $mock = $this->getMockForTrait(MapTypeTrait::class);

        $this->expectException(MappedTypesNotImplemented::class);
        $mock->getMappedTypes();
    }

    public function testGetMappedTypeValue()
    {
        $roadmap_type_mapped = 'roadmap_type_mapped';

        $mapped_types = [
            MapType::ROADMAP_TYPE => $roadmap_type_mapped,
            MapType::SATELLITE_TYPE => 'satellite_type_mapped',
            MapType::HYBRID_TYPE => 'hybrid_type_mapped',
        ];

        $this->mock
            ->expects($this->any())
            ->method('getMappedTypes')
            ->will($this->returnValue($mapped_types));

        $this->assertEquals($roadmap_type_mapped, $this->mock->getMappedTypeValue(MapType::ROADMAP_TYPE));
        
        $this->expectException(BadMappedMapTypeException::class);
        $this->mock->getMappedTypeValue(MapType::TERRAIN_TYPE);
    }
}