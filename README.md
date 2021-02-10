# Autoload

This class is an implementation of the [PSR4](https://www.php-fig.org/psr/psr-4/) standard defined in [PHP-FIG](https://www.php-fig.org/).

Autoload\Psr4 is an autoloader that implements PSR-4. Just like any autoloader, depending on its setup, it will try and find the files your code is looking for based on file, class, namespace etc. 

Usually we would use the spl_autoload_register() to register a custom autoloader for our application. Autoload\Psr4 hides this complexity. After you define all your namespaces, classes, directories and files you will need to call the autoload() function, and the autoloader is ready to be used.


### Exemple
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
