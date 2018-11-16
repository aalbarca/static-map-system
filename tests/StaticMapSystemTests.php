<?php

namespace Netflie\StaticMapSystem\Test;

use Netflie\StaticMapSystem\Adapter\AdapterInterface;
use Netflie\StaticMapSystem\Entity\Format as MapFormat;
use Netflie\StaticMapSystem\Entity\MapType;
use Netflie\StaticMapSystem\Exception\FormatNotFoundException;
use Netflie\StaticMapSystem\Exception\MapTypeNotFoundException;
use Netflie\StaticMapSystem\StaticMapSystem;

use Prophecy\Prophecy\ObjectProphecy;
use PHPUnit\Framework\TestCase;

class StaticMapSystemTests extends TestCase
{
    /**
     * @var ObjectProphecy
     */
    protected $prophecy;

    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var StaticMapSystem
     */
    protected $staticMapSystem;

    /**
     * @before
     */
    public function setupAdapter()
    {
        $this->prophecy = $this->prophesize(AdapterInterface::class);
        $this->adapter = $this->prophecy->reveal();
        $this->staticMapSystem = new StaticMapSystem($this->adapter);
    }

    public function testGetAdapter()
    {
        $this->assertEquals($this->adapter, $this->staticMapSystem->getAdapter());
    }

    public function testSetCenter()
    {
        $center = "Cala Millor, SP";
        $this->prophecy->setCenter($center)->willReturn(true);
        $this->assertTrue($this->staticMapSystem->setCenter($center));
    }

    public function testSetSize()
    {
        $width = '500'; // 500px
        $height = '250'; // 250px

        $this->prophecy->setSize($width, $height)->willReturn(true);
        $this->assertTrue($this->staticMapSystem->setSize($width, $height));
    }

    public function testSetZoom()
    {
        $zoom = 5;

        $this->prophecy->setZoom($zoom)->willReturn(true);
        $this->assertTrue($this->staticMapSystem->setZoom($zoom));
    }

    public function testSetMapType()
    {
        $validMapType = MapType::ROADMAP_TYPE;
        $wrongMapType = 'wrong_map_type';

        $this->prophecy->setMapType($validMapType)->willReturn(true);
        $this->assertTrue($this->staticMapSystem->setMapType($validMapType));

        $this->expectException(MapTypeNotFoundException::class);
        $this->staticMapSystem->setMapType($wrongMapType);
    }

    public function testSetFormat()
    {
        $validFormat = MapFormat::JPEG;
        $wrongFormat = 'wrong_map_format';

        $this->prophecy->setFormat($validFormat)->willReturn(true);
        $this->assertTrue($this->staticMapSystem->setFormat($validFormat));

        $this->expectException(FormatNotFoundException::class);
        $this->staticMapSystem->setFormat($wrongFormat);
    }

    public function testAddMarker()
    {
        $marker = 'color:blue|label:S|11211|11206|11222';
        $this->prophecy->addMarker($marker)->willReturn(true);
        $this->assertTrue($this->staticMapSystem->addMarker($marker));
    }

    public function testGetImgTagWithoutOptions()
    {
        $width = '500';
        $height = '250';
        $uri = 'https://api.staticmapservice.tld';
        $expectedTag = "<img width=\"$width\" height=\"$height\" src=\"$uri\" >";

        $this->prophecy->getWidth()->willReturn($width);
        $this->prophecy->getHeight()->willReturn($height);
        $this->prophecy->getUri()->willReturn($uri);
        $this->assertEquals($expectedTag, $this->staticMapSystem->getImgTag());
    }

    public function testGgetImgTagWithExtraOptions()
    {
        $width = '500';
        $height = '250';
        $options = [
            'class' => 'static-map-class'
        ];
        $uri = 'https://api.staticmapservice.tld';
        $expectedTag = "<img width=\"$width\" height=\"$height\" class=\"static-map-class\" src=\"$uri\" >";

        $this->prophecy->getWidth()->willReturn($width);
        $this->prophecy->getHeight()->willReturn($height);
        $this->prophecy->getUri()->willReturn($uri);
        $this->assertEquals($expectedTag, $this->staticMapSystem->getImgTag($options));  
    }

    public function testGetImgTagWithReplacedOptions()
    {
        $width = '500';
        $height = '250';
        $options = [
            'class' => 'static-map-class',
            'width' => '444',
            'height' => '333',
        ];
        $uri = 'https://api.staticmapservice.tld';
        $expectedTag = "<img width=\"{$options['width']}\" height=\"{$options['height']}\" class=\"static-map-class\" src=\"$uri\" >";

        $this->prophecy->getWidth()->willReturn($width);
        $this->prophecy->getHeight()->willReturn($height);
        $this->prophecy->getUri()->willReturn($uri);
        $this->assertEquals($expectedTag, $this->staticMapSystem->getImgTag($options));
    }
}