<?php

namespace Nack\FileParser\Strategy;

class CsvRowsStrategyTest extends \PHPUnit_Framework_TestCase
{
    /** @var CsvRowsStrategy */
    private $sut;

    public function setUp()
    {
        $this->sut = new CsvRowsStrategy();
    }

    public function testItShouldParseKeyValueRows()
    {
        $row1 = [ 'foo', 'bar' ];
        $row2 = [ 'beep', 'boop' ];

        $file = $this->getMock('SplFileObject', [ ], [ 'php://memory' ]);

        $file->expects($this->exactly(3))->method('eof')->willReturnOnConsecutiveCalls(false, false, true);
        $file->expects($this->exactly(2))->method('fgetcsv')->willReturnOnConsecutiveCalls($row1, $row2);

        $expected = [
            'foo' => 'bar',
            'beep' => 'boop'
        ];

        $this->assertEquals($expected, $this->sut->parse($file));
    }

    public function testItShouldIgnoreEmptyRowsAndRowsWithAnEmptyKey()
    {
        $row1 = [ null ];
        $row2 = [ '', 'foo'];
        $row3 = [ 'beep', null ];

        $file = $this->getMock('SplFileObject', [ ], [ 'php://memory' ]);

        $file->expects($this->exactly(4))->method('eof')->willReturnOnConsecutiveCalls(false, false, false, true);
        $file->expects($this->exactly(3))->method('fgetcsv')->willReturnOnConsecutiveCalls($row1, $row2, $row3);

        $expected = [
            'beep' => null
        ];

        $this->assertEquals($expected, $this->sut->parse($file));
    }

    public function testItShouldSetKeyToAnArrayOfValuesIfRowLongerThanTwoValues()
    {
        $row1 = [ 'foo', 'bar', 'baz' ];
        $row2 = [ 'bagel', 'cream', null, 'cheese' ];
        $row3 = [ 'beep', 'boop' ];

        $file = $this->getMock('SplFileObject', [ ], [ 'php://memory' ]);

        $file->expects($this->exactly(4))->method('eof')->willReturnOnConsecutiveCalls(false, false, false, true);
        $file->expects($this->exactly(3))->method('fgetcsv')->willReturnOnConsecutiveCalls($row1, $row2, $row3);

        $expected = [
            'foo' => [ 'bar', 'baz' ],
            'bagel' => [ 'cream', null, 'cheese' ],
            'beep' => 'boop'
        ];

        $this->assertEquals($expected, $this->sut->parse($file));
    }
}
