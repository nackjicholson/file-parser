<?php

namespace Nack\FileParser;

class FileParserAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testItShouldSetFileParser()
    {
        $fileParser = $this->getMock(__NAMESPACE__ . '\\FileParser');

        /** @var FileParserAwareTrait $trait */
        $trait = $this->getMockForTrait(__NAMESPACE__ . '\\FileParserAwareTrait');
        $trait->setFileParser($fileParser);
        $this->assertAttributeSame($fileParser, 'fileParser', $trait);
    }
}
