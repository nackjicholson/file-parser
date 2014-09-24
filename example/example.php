<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

// yaml from a path.
print_r($fileParser->yaml('foobar.yml'));

// columnar yaml list
print_r($fileParser->yaml('columnar.yml'));

// json from a file info object.
$fileInfo = new \SplFileInfo('foobar.json');
print_r($fileParser->json($fileInfo));

// csv normal
print_r($fileParser->csvRows('foobar.csv'));

// csv columnar from file object.
$fileObject = new \SplFileObject('columnar.csv');
print_r($fileParser->csvColumnar($fileObject));

// csv rows
print_r($fileParser->csvRows('rows.csv'));
