<?php

namespace Netflie\StaticMapSystem\Test;

use Netflie\StaticMapSystem\FormatTrait;
use Netflie\StaticMapSystem\Entity\Format as MapFormat;
use Netflie\StaticMapSystem\Exception\FormatNotFoundException;
use Netflie\StaticMapSystem\Exception\MappedFormatsNotImplemented;
use Netflie\StaticMapSystem\Exception\BadMappedFormatTypeException;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FormatTraitTests extends TestCase
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
        $this->mock = $this->getMockForTrait(FormatTrait::class, [], '', true, true, true, ['getMappedFormats']);
    }

    public function testGetFormats()
    {
        $expected_formats = [
            MapFormat::PNG,
            MapFormat::JPEG,
        ];

        $this->assertArraySubset($expected_formats, $this->mock->getFormats());
    }

    public function testFormatExists()
    {
        $format_1 = MapFormat::PNG;
        $format_2 = MapFormat::JPEG;
        $fake_format = 'fake_format';

        $this->assertTrue($this->mock->formatExists($format_1));
        $this->assertTrue($this->mock->formatExists($format_2));
        $this->assertFalse($this->mock->formatExists($fake_format));
    }

    public function testAssertFormatExists()
    {
        $fake_format = 'fake_format';

        $this->expectException(FormatNotFoundException::class);
        $this->mock->assertFormatExists($fake_format);
    }

    public function testGetMappedFormats()
    {
        $mock = $this->getMockForTrait(FormatTrait::class);

        $this->expectException(MappedFormatsNotImplemented::class);
        $mock->getMappedFormats();
    }

    public function testGetMappedFormatValue()
    {
        $png_format_mapped = 'png_format_mapped';

        $mapped_formats = [
            MapFormat::PNG => $png_format_mapped,
        ];

        $this->mock
            ->expects($this->any())
            ->method('getMappedFormats')
            ->will($this->returnValue($mapped_formats));

        $this->assertEquals($png_format_mapped, $this->mock->getMappedFormatValue(MapFormat::PNG));
        
        $this->expectException(BadMappedFormatTypeException::class);
        $this->mock->getMappedFormatValue(MapFormat::JPEG);
    }

}