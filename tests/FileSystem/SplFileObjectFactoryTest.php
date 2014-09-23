<?php

namespace Cascade\FileSystem;

class SplFileObjectFactoryTest extends \PHPUnit_Framework_TestCase
{
    /** @var SplFileObjectFactory */
    private $factory;

    public function setUp()
    {
        $this->factory = new SplFileObjectFactory();
    }

    public function testItShouldCreateAnSplFileObjectWhenGivenAPath()
    {
        $splFileObject = $this->factory->create('php://memory');

        $this->assertInstanceOf('\\SplFileObject', $splFileObject);
    }
}
