<?php

namespace Nack\FileParser;

class FileParserTest extends \PHPUnit_Framework_TestCase
{
    /** @var FileParser */
    private $sut;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $splFileObjectFactory;

    /** @var \PHPUnit_Framework_MockObject_MockObject */
    private $strategyFactory;

    public function setUp()
    {
        $this->constructMocks();

        $this->sut = new FileParser($this->splFileObjectFactory, $this->strategyFactory);
    }

    /**
     * @dataProvider formatProvider
     */
    public function testAllFormats($testMethod, $factoryMethod)
    {
        $path = 'bagel.yml';
        $result = [ 'yaml' => 'here' ];

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        $this->splFileObjectFactory->expects($this->once())->method('create')->with($path)->willReturn($file);

        $strategy = $this->getMock('Nack\\FileParser\\Strategy\\StrategyInterface');
        $strategy->expects($this->once())->method('parse')->with($file)->willReturn($result);

        $this->strategyFactory->expects($this->once())->method($factoryMethod)->willReturn($strategy);

        $this->assertSame($result, $this->sut->{$testMethod}($path));
    }

    public function formatProvider()
    {
        return [
            [ 'csv', 'createCsvStrategy' ],
            [ 'json', 'createJsonStrategy' ],
            [ 'yaml', 'createYamlStrategy' ]
        ];
    }

    private function constructMocks()
    {
        $this->splFileObjectFactory = $this->getMock(__NAMESPACE__ . '\\FileSystem\\SplFileObjectFactory');
        $this->strategyFactory = $this->getMock(__NAMESPACE__ . '\\Strategy\\StrategyFactoryInterface');
    }
}
