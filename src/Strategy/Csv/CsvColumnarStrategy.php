<?php

namespace Nack\FileParser\Strategy\Csv;

use Nack\FileParser\Strategy\AbstractStrategy;

/**
 * Strategy for parsing csv content in a columnar fashion.
 */
class CsvColumnarStrategy extends AbstractStrategy
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
        $delimiter = $this->options['delimiter'];
        $enclosure = $this->options['enclosure'];
        $escape = $this->options['escape'];

        $header = $file->fgetcsv($delimiter, $enclosure, $escape);

        $result = [];

        while (!$file->eof()) {
            $line = $file->fgetcsv($delimiter, $enclosure, $escape);

            // If row is not a blank line.
            if (!empty($line[0])) {
                $result[] = array_combine($header, $line);
            }
        }

        return $result;
    }
}
