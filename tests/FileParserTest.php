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
        $line1 = 'foo';
        $line2 = 'bar';
        $content = $line1 . $line2;
        $result = [ 'yaml' => 'here' ];

        $file = $this->getMock('SplFileObject', [], ['php://memory']);

        // Yaml string extraction from file via iteration of lines.
        $file->expects($this->exactly(3))->method('valid')->willReturnOnConsecutiveCalls(true, true, false);
        $file->expects($this->exactly(2))->method('current')->willReturnOnConsecutiveCalls($line1, $line2);
        $file->expects($this->exactly(2))->method('next')->withAnyParameters();

        $this->splFileObjectFactory->expects($this->once())->method('create')->with($path)->willReturn($file);

        $strategy = $this->getMock('Nack\\FileParser\\Strategy\\StrategyInterface');
        $strategy->expects($this->once())->method('parse')->with($content)->willReturn($result);

        $this->strategyFactory->expects($this->once())->method($factoryMethod)->willReturn($strategy);

        $this->assertSame($result, $this->sut->{$testMethod}($path));
    }

    public function formatProvider()
    {
        return [
            [ 'json', 'createJsonStrategy' ],
            [ 'yaml', 'createYamlStrategy' ]
        ];
    }

    private function constructMocks()
    {
        $this->splFileObjectFactory = $this->getMock('Cascade\\FileSystem\\SplFileObjectFactory');
        $this->strategyFactory = $this->getMock(__NAMESPACE__ . '\\Strategy\\StrategyFactoryInterface');
    }
}
