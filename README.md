## Example:

*foobar.yml*
```yaml
foo: bar
```

*foobar.json*
```json
{
    "foo": "bar"
}
```

*foobar.csv*
```
foo,beep
bar,boop
```

*example.php*
```php
<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

print_r($fileParser->yaml('foobar.yml'));
print_r($fileParser->json('foobar.json'));
print_r($fileParser->csv('foobar.csv'));
```

Outputs:

```
Array
(
    [foo] => bar
)
Array
(
    [foo] => bar
)
Array
(
    [0] => Array
        (
            [foo] => bar
            [beep] => boop
        )

)
```
