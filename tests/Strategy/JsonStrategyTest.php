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
        $content = '{"foo": "bar"}';
        $result = [ 'foo' => 'bar' ];
        $this->assertEquals($result, $this->sut->parse($content));
    }
}
