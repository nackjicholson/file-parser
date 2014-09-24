<?php

namespace Nack\FileParser\Strategy;

class CsvColumnsStrategyTest extends \PHPUnit_Framework_TestCase
{
    /** @var CsvColumnsStrategy */
    private $sut;

    public function setUp()
    {
        $this->sut = new CsvColumnsStrategy();
    }

    public function testParse()
    {
        $header = [ 'foo', 'beep' ];
        $row = [ 'bar', 'boop' ];
        $emptyRow = [ null ];

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        $file
            ->expects($this->exactly(3))
            ->method('fgetcsv')
            ->willReturnOnConsecutiveCalls($header, $row, $emptyRow);

        $file
            ->expects($this->exactly(3))
            ->method('eof')
            ->willReturnOnConsecutiveCalls(false, false, true);

        $expectedResult = [
            [
                'foo' => 'bar',
                'beep' => 'boop'
            ]
        ];

        $this->assertEquals($expectedResult, $this->sut->parse($file));
    }
}
