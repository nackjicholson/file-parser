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
    public function testAllFormats($fileArgument, $testMethod, $factoryMethod)
    {
        $result = [ 'yaml' => 'here' ];

        $fileObject = $this->getMock('SplFileObject', [], ['php://memory']);

        if (is_string($fileArgument)) {
            $this->splFileObjectFactory
                ->expects($this->once())
                ->method('create')
                ->with($fileArgument)
                ->willReturn($fileObject);
        } elseif ($fileArgument instanceof \SplFileInfo) {
            /** @var \PHPUnit_Framework_MockObject_MockObject $fileArgument */
            $fileArgument
                ->expects($this->once())
                ->method('openFile')
                ->willReturn($fileObject);
        }

        $strategy = $this->getMock('Nack\\FileParser\\Strategy\\StrategyInterface');
        $strategy->expects($this->once())->method('parse')->with($fileObject)->willReturn($result);

        $this->strategyFactory->expects($this->once())->method($factoryMethod)->willReturn($strategy);

        $this->assertSame($result, $this->sut->{$testMethod}($fileArgument));
    }

    public function formatProvider()
    {
        $filePath = 'bagel';
        $fileInfo = $this->getMock('SplFileInfo', [], ['php://memory']);
        $fileObject = $this->getMock('SplFileObject', [], ['php://memory']);

        return [
            [ $filePath, 'csvColumnar', 'createCsvColumnarStrategy' ],
            [ $fileInfo, 'json', 'createJsonStrategy' ],
            [ $fileObject, 'yaml', 'createYamlStrategy' ]
        ];
    }

    private function constructMocks()
    {
        $this->splFileObjectFactory = $this->getMock(__NAMESPACE__ . '\\FileSystem\\SplFileObjectFactory');
        $this->strategyFactory = $this->getMock(__NAMESPACE__ . '\\Strategy\\StrategyFactoryInterface');
    }
}
