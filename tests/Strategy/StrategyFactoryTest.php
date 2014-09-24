<?php

namespace Nack\FileParser\Strategy;

use Symfony\Component\Yaml\Parser;

class StrategyFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var StrategyFactory */
    private $sut;

    public function setUp()
    {
        $this->sut = new StrategyFactory();
    }

    public function testItShouldCreateCsvColumnsStrategy()
    {
        $expected = new CsvColumnsStrategy();
        $this->assertEquals($expected, $this->sut->createCsvColumnsStrategy());
    }

    public function testItShouldCreateJsonStrategy()
    {
        $expected = new JsonStrategy();
        $this->assertEquals($expected, $this->sut->createJsonStrategy());
    }

    public function testItShouldCreateYamlStrategy()
    {
        $expected = new YamlStrategy(new Parser());
        $this->assertEquals($expected, $this->sut->createYamlStrategy());
    }
}
