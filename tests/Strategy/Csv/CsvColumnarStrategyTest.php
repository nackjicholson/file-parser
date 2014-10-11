<?php

namespace Nack\FileParser\Strategy\Csv;

class CsvColumnarStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldParseCsvAsColumnarData()
    {
        $sut = new CsvColumnarStrategy();

        $options = $this->readAttribute($sut, 'options');
        $header = [ 'foo', 'beep' ];
        $row = [ 'bar', 'boop' ];
        $emptyRow = [ null ];

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        $file
            ->expects($this->exactly(3))
            ->method('eof')
            ->willReturnOnConsecutiveCalls(false, false, true);
        $file
            ->expects($this->exactly(3))
            ->method('fgetcsv')
            ->with($options['delimiter'], $options['enclosure'], $options['escape'])
            ->willReturnOnConsecutiveCalls($header, $row, $emptyRow);

        $expectedResult = [
            [
                'foo' => 'bar',
                'beep' => 'boop'
            ]
        ];

        $this->assertEquals($expectedResult, $sut->parse($file));
    }
}
