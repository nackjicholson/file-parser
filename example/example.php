<?php

require __DIR__ . '/../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

// yaml from a path.
print_r($fileParser->yaml(__DIR__ . '/foobar.yml'));

// columnar yaml list
print_r($fileParser->yaml(__DIR__ . '/columnar.yml'));

// json from a file info object.
$fileInfo = new \SplFileInfo(__DIR__ . '/foobar.json');
print_r($fileParser->json($fileInfo));

// csv normal
print_r($fileParser->csv(__DIR__ . '/foobar.csv'));

// csv columnar from file object.
$fileObject = new \SplFileObject(__DIR__ . '/columnar.csv');
print_r($fileParser->csvColumnar($fileObject, ['delimiter' => ';']));

// csv rows
print_r($fileParser->csvRows(__DIR__ . '/rows.csv'));

//print_r($fileParser->ini('/opt/local/etc/php55/php.ini'));
