<?php

namespace Nack\FileParser\Strategy;

use Nack\FileParser\Strategy\Csv\CsvColumnarStrategy;
use Nack\FileParser\Strategy\Csv\CsvRowsStrategy;
use Nack\FileParser\Strategy\Csv\CsvStrategy;
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
        $options = ['delimiter' => ';'];
        $expected = new CsvStrategy();
        $expected->setOptions($options);

        $this->assertEquals($expected, $this->sut->createCsvStrategy($options));
    }

    public function testItShouldCreateCsvColumnarStrategy()
    {
        $options = ['delimiter' => ';'];
        $expected = new CsvColumnarStrategy();
        $expected->setOptions($options);

        $this->assertEquals($expected, $this->sut->createCsvColumnarStrategy($options));
    }

    public function testItShouldCreateCsvRowsStrategy()
    {
        $options = ['delimiter' => ';'];
        $expected = new CsvRowsStrategy();
        $expected->setOptions($options);

        $this->assertEquals($expected, $this->sut->createCsvRowsStrategy($options));
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
