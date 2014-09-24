<?php

namespace Nack\FileParser\Strategy;

function parse_ini_file($filename) {
    \PHPUnit_Framework_Assert::assertEquals(IniStrategyTest::FILENAME, $filename);
    return [ 'parsed' => 'ini' ];
}

class IniStrategyTest extends \PHPUnit_Framework_TestCase
{
    const FILENAME = 'bagel.ini';

    public function testParseAnIni()
    {
        $file = $this->getMock('SplFileObject', [ ], [ 'php://memory' ]);
        $file->expects($this->once())->method('getPathname')->willReturn(self::FILENAME);
        $sut = new IniStrategy();
        $this->assertEquals([ 'parsed' => 'ini' ], $sut->parse($file));
    }
}
