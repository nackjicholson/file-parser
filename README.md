file-parser
===

This is a composer package for parsing files that contain structured data.

The current supported formats are:

- Csv
- Json
- Yaml
- .ini

**WARNING** Only works with PHP 5.4 and up due to short array syntax and use of traits.

## Example:

*foobar.yml*
```yaml
foo: bar
```
*example.php*
```php
<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

print_r($fileParser->yaml('foobar.yml'));
```
Outputs:
```
Array
(
    [foo] => bar
)
```

## Install

Via [composer](http://getComposer.org)

`compser require nackjicholson/file-parser=~2.1`

or add too composer.json
```json
"require": {
    "nackjicholson/file-parser": "~2.1"
}
```

## CSV

This library provides three ways to parse a csv file into a php array. There is full
support for delimiter, enclosure, and escape options by passing an associative
array of options to each csv method. Options default to:

```
['delimiter' => ',', 'enclosure' => '"', 'escape' => '\\']
```

There is an example of how to set a file to parse with a `;` delimiter in `example/example.php`.

### ::csv(mixed $file, array $options = [])

This method provides a literal parse of a file as a csv. Each line is translated to an
array of values. Empty lines are not skipped.

```
foo,bar
,empty first value

bingo,bango,bongo
```
`$fileParser->csv('file.csv');`
```
[
    [ 'foo', 'bar' ],
    [ '', 'empty first value' ],
    [ null ],
    [ 'bingo', 'bango', 'bongo' ]
]
```

### ::csvColumnar(mixed $file, array $options = [])

Parses the contents of a csv as data structured columnar. Takes into account the first row of a csv file as column headers, and attaches each column header to its associated row value.

For example, a csv describing a table of contacts.
```
name,email,phone
will,willieviseoae@gmail.com,555-2242
bill,,
,,
```
The first row is the headers of the table 'name', 'email', and 'phone'.
The second row is a complete set of data.
The third has a name, but empty email and phone.
The fourth is not a row, it's a blank line.

`$fileParser->csvColumnar('contacts.csv');`
```
[
    [
        'name' => 'will',
        'email' => 'willieviseoae@gmail.com',
        'phone' => '555-2242'
    ],
    [
        'name' => 'bill',
        'email' => '',
        'phone' => ''
    ]
]
```

### ::csvRows(mixed $file, array $options = [])

Parses the contents of a csv where each row uses the first value as a key, which is set with the subsequent values. This is ideal for a csv which describes a set of `key => value` pairs, or `key => [ values... ]`.

```
foo,bar
bingo,bango,bongo
,,
,nope,not,a,chance
emptyValue,
```
`$fileParser->csvRows('rows.csv');`
```
[
    'foo' => 'bar',
    'bingo' => [ 'bango', 'bongo' ],
    'emptyValue' => ''
]
```

As you can see it ignores blank lines, or lines where the key would be empty.

## INI

### ::ini(mixed $file)

This method will parse a php ini configuration file into an array. It delegates directly to PHP's built in function `parse_ini_file`.

`$fileParse->ini('/etc/php55/php.ini');`

## JSON

### ::json(mixed $file)

Parses a json file into a php array. This parsing strategy delegates directly to PHP's built in `json_decode`.

```json
{
    "foo": "bar"
}
```
`$fileParser->json('foobar.json');`
```
[ 'foo' => 'bar' ]
```

## YAML

### ::yaml(mixed $file)

Parses a yaml file into a php array. This parsing strategy delegates directly to [symfony/Yaml](http://github.com/symfony/Yaml)

```
foo: bar
```
`$fileParser->yaml('foobar.yml');`
```
[ 'foo' => 'bar' ]
```

## SplFileInfo and SplFileObject Support

Instead of passing a path to any of the file-parser methods. You can supply either a `SplFileInfo` or `SplFileObject` object.

```php
$fileParser = new FileParser();

$splFileInfo = new \SplFileInfo('path/to/file.yml');
$fileParser->yaml($splFileInfo);

$splFileObject = new \SplFileObject('path/to/file.json');
$fileParser->json($splFileObject);
```

## Contributing

Report issues, and feel free to make requests there. Tag github issues with the best label you can.
If this library doesn't do something you want, it's not difficult to extend. The library is built on the strategy pattern, new strategies can parse data differently.
Write tests, and make pull requests. If you do not test your code with 100% coverage, your PR will be rejected.

## Contact me

Will Vaughn

email: willieviseoae@gmail.com

twitter: [@nackjicholsonn](http://twitter.com/nackjicholsonn)
