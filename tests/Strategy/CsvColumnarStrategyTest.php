<?php

namespace Nack\FileParser\Strategy;

class CsvColumnarStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldParseCsvAsColumnarData()
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

        $sut = new CsvColumnarStrategy();
        $this->assertEquals($expectedResult, $sut->parse($file));
    }
}
