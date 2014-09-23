<?php

namespace Nack\FileParser\Strategy;

class JsonStrategyTest extends \PHPUnit_Framework_TestCase
{
    /** @var JsonStrategy */
    private $sut;

    public function setUp()
    {
        $this->sut = new JsonStrategy();
    }

    public function testParse()
    {
        $line1 = '{"foo":';
        $line2 = ' "bar"}';
        $content = $line1 . $line2;
        $expected = json_decode($content, true);

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        // Yaml string extraction from file via iteration of lines.
        $file->expects($this->exactly(3))->method('valid')->willReturnOnConsecutiveCalls(true, true, false);
        $file->expects($this->exactly(2))->method('current')->willReturnOnConsecutiveCalls($line1, $line2);
        $file->expects($this->exactly(2))->method('next')->withAnyParameters();

        $this->assertEquals($expected, $this->sut->parse($file));
    }
}
