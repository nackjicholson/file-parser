file-parser
===

This a composer package for parsing files that contain structured data.

The current supported formats are:

- Csv
- Json
- Yaml
- .ini

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

`compser require nackjicholson/file-parser=~2.0`

or add too composer.json
```json
"require": {
    "nackjicholson/file-parser": "~2.0"
}
```

## CSV

This library provides three ways to parse a csv file into a php array.

**WARNING:** Right now only ',' delimeters are supported. Please contribute :)

### ::csv

This method provides a literal parse of a file as a csv. Each line is translated to an array of values. Empty lines are not skipped.

```
foo,bar
,empty first value

bingo,bango,bongo
```
```
[
    [ 'foo', 'bar' ],
    [ '', 'empty first value' ],
    [ null ],
    [ 'bingo', 'bango', 'bongo' ]
]
```

### ::csvColumnar

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

Parsing this produces:
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

### ::csvRows

Parses the contents of a csv where each row uses the first value as a key, which is set with the subsequent values. This is ideal for a csv which describes a set of `key => value` pairs, or `key => [ values... ]`.

```
foo,bar
bingo,bango,bongo
,,
,nope,not,a,chance
emptyValue,
```
```
[
    'foo' => 'bar',
    'bingo' => [ 'bango', 'bongo' ],
    'emptyValue' => ''
]
```

As you can see it ignores blank lines, or lines where the key would be empty.

## JSON

### ::json

Parses a json file into a php array. This parsing strategy delegates directly to php's built in `json_decode`.

```json
{
    "foo": "bar"
}
```
```
[ 'foo' => 'bar' ]
```

## YAML

### ::yaml

Parses a yaml file into a php array. This parsing strategy delegates directly to [symfony/Yaml](http://github.com/symfony/Yaml)

```
foo: bar
```
```
[ 'foo' => 'bar' ]
```
