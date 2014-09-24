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

    public function testItShouldCreateCsvStrategy()
    {
        $expected = new CsvStrategy();
        $this->assertEquals($expected, $this->sut->createCsvStrategy());
    }

    public function testItShouldCreateCsvColumnarStrategy()
    {
        $expected = new CsvColumnarStrategy();
        $this->assertEquals($expected, $this->sut->createCsvColumnarStrategy());
    }

    public function testItShouldCreateCsvRowsStrategy()
    {
        $expected = new CsvRowsStrategy();
        $this->assertEquals($expected, $this->sut->createCsvRowsStrategy());
    }

    public function testItShouldCreateIniStrategy()
    {
        $expected = new IniStrategy();
        $this->assertEquals($expected, $this->sut->createIniStrategy());
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
