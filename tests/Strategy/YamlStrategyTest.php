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
        $content = 'foo';
        $parsedValue = [ 'foo' ];
        $this->parser->expects($this->once())->method('parse')->with($content)->willReturn($parsedValue);
        $this->assertSame($parsedValue, $this->sut->parse($content));
    }
}
