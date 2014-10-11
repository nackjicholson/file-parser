<?php

namespace Nack\FileParser\Strategy\Csv;

use Nack\FileParser\Strategy\AbstractLineStrategy;

abstract class AbstractCsvLineStrategy extends AbstractLineStrategy
{
    /** @var array Hash of configuration options for this strategy. */
    protected $options = [
        'delimiter' => ',',
        'enclosure' => '"',
        'escape' => '\\'
    ];

    /**
     * Parses a file of data into a php array.
     *
     * @param \SplFileObject $file
     *
     * @return array
     */
    public function parse(\SplFileObject $file)
    {
        $result = [];
        $delimiter = $this->options['delimiter'];
        $enclosure = $this->options['enclosure'];
        $escape = $this->options['escape'];

        while (!$file->eof()) {
            $this->formatLine($result, $file->fgetcsv($delimiter, $enclosure, $escape));
        }

        return $result;
    }
}
