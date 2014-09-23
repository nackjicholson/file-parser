<?php

namespace Nack\FileParser\Strategy;

class YamlStrategyTest extends \PHPUnit_Framework_TestCase
{
    /** @var YamlStrategy */
    private $sut;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $parser;

    public function setUp()
    {
        $this->parser = $this->getMock('Symfony\\Component\\Yaml\\Parser');
        $this->sut = new YamlStrategy($this->parser);
    }

    public function testParse()
    {
        $line1 = 'foo: ';
        $line2 = 'bar';
        $content = $line1 . $line2;
        $expected = [ 'foo' => 'bar' ];

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        // Yaml string extraction from file via iteration of lines.
        $file->expects($this->exactly(3))->method('valid')->willReturnOnConsecutiveCalls(true, true, false);
        $file->expects($this->exactly(2))->method('current')->willReturnOnConsecutiveCalls($line1, $line2);
        $file->expects($this->exactly(2))->method('next')->withAnyParameters();

        $this->parser->expects($this->once())->method('parse')->with($content)->willReturn($expected);
        $this->assertSame($expected, $this->sut->parse($file));
    }
}
