# Autoload

This class is an implementation of the [PSR4](https://www.php-fig.org/psr/psr-4/) standard defined in [PHP-FIG](https://www.php-fig.org/).


```php
<?php
require_once 'src/Autoload/Psr4.php';

$class = new Autoload\Psr4('namespace.json');

$class->autoload();
```

or

```php
<?php
require_once 'src/Autoload/Psr4.php';

$class = new Autoload\Psr4(
    [
        #namespace    #path
        "Codev"    => "src/codev",
        "Cms"      => "app",
    ]
);

$class->autoload();
```
