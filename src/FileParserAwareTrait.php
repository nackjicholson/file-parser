<?php

namespace Nack\FileParser;

/**
 * Trait which encapsulates a class' awareness of a fileParser dependency.
 */
trait FileParserAwareTrait
{
    /** @var FileParser */
    protected $fileParser;

    /**
     * @param FileParser $fileParser
     */
    public function setFileParser(FileParser $fileParser)
    {
        $this->fileParser = $fileParser;
    }
}
