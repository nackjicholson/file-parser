<?php

namespace Nack\FileParser\FileSystem;

class GetFileContentsTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetFileContents()
    {
        $line1 = 'foo';
        $line2 = 'bar';
        $expectedResult = $line1 . $line2;

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        // Yaml string extraction from file via iteration of lines.
        $file->expects($this->exactly(3))->method('valid')->willReturnOnConsecutiveCalls(true, true, false);
        $file->expects($this->exactly(2))->method('current')->willReturnOnConsecutiveCalls($line1, $line2);
        $file->expects($this->exactly(2))->method('next')->withAnyParameters();

        $harness = new GetFileContentsHarness();
        $actual = $harness->executeGetFileContents([$file]);

        $this->assertEquals($expectedResult, $actual);
    }
}
