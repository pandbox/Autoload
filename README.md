# Autoload

This class is an implementation of the [PSR4](https://www.php-fig.org/psr/psr-4/) standard defined in [PHP-FIG](https://www.php-fig.org/).

***Autoload\Psr4*** is an autoloader that implements *`PSR-4`*. Just like any autoloader, depending on its setup, it will try and find the files your code is looking for based on file, class, namespace etc.

This component relies on PHP’s autoloading classes capability. If a class defined in the code has not been included yet, a special handler will try to load it. ***Autoload\Psr4*** serves as the special handler for this operation. 

Usually we would use the ```spl_autoload_register()``` to register a custom autoloader for our application. ***Autoload\Psr4*** hides this complexity. After you define all your namespaces, classes, directories and files you will need to call the ```autoload()``` function, and the autoloader is ready to be used.


>To add a namespace conforming to *`PSR-4`* specifications, point to the base directory for that namespace. Multiple base directories are allowed, and will be searched in the order they are added.


## Exemple

***Autoload\Psr4*** you can run passing it the namespace values in a json file as shown below ...

```php
<?php
require_once 'src/Autoload/Psr4.php';

$class = new Autoload\Psr4('loader.json');

$class->autoload();
```

The loader.json file should have a structure similar to this ...

```json
{
    "autoload": {
        "Foo": "path/to/foo",
        "Bar": "path/to/foo/Bar",
        "Baz\\Qux": "path/to/Baz/Qux"
    }
}
```

You can pass the namespace values to ***Autoload\Psr4*** as an array directly in the class instance ...

```php
<?php
require_once 'src/Autoload/Psr4.php';

$class = new Autoload\Psr4(
    [
        #Prefixes      #Path
        "Foo"      =>  "path/to/foo",
        "Bar"      =>  "path/to/foo/Bar",
        "Baz\\Qux" =>  "path/to/Baz/Qux"
    ]
);

$class->autoload();
```
