<?php

namespace Nack\FileParser\Strategy;

class CsvStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldParseCsvToPhpArray()
    {
        $row1 = [ 'foo', 'bar' ];
        $row2 = [ null ];
        $row3 = [ '', 'bagel', 'cream', '', 'cheese'];

        $file = $this->getMock('SplFileObject', [ ], [ 'php://memory' ]);

        $file->expects($this->exactly(4))->method('eof')->willReturnOnConsecutiveCalls(false, false, false, true);
        $file->expects($this->exactly(3))->method('fgetcsv')->willReturnOnConsecutiveCalls($row1, $row2, $row3);

        $expected = [ $row1, $row2, $row3 ];

        $sut = new CsvStrategy();
        $this->assertEquals($expected, $sut->parse($file));
    }
}
