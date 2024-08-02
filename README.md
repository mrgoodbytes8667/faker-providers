# faker-providers
[![Packagist Version](https://img.shields.io/packagist/v/mrgoodbytes8667/faker-providers?logo=packagist&logoColor=FFF&style=flat)](https://packagist.org/packages/mrgoodbytes8667/faker-providers)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/mrgoodbytes8667/faker-providers?logo=php&logoColor=FFF&style=flat)](https://packagist.org/packages/mrgoodbytes8667/faker-providers)
![Symfony Versions Supported](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fsymfony%2F%255E5.2%2520%257C%2520%255E6.0%2520%257C%2520%255E7.0&logoColor=FFF&style=flat)
![Symfony LTS Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Flts%2F%255E5.2%2520%257C%2520%255E6.0%2520%257C%2520%255E7.0&logoColor=FFF&style=flat)
![Symfony Stable Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fstable%2F%255E5.2%2520%257C%2520%255E6.0%2520%257C%2520%255E7.0&logoColor=FFF&style=flat)
![Symfony Dev Version](https://img.shields.io/endpoint?url=https%3A%2F%2Fshields.mrgoodbytes.dev%2Fshield%2Fdev%2F%255E5.2%2520%257C%2520%255E6.0%2520%257C%2520%255E7.0&logoColor=FFF&style=flat)
![Packagist License](https://img.shields.io/packagist/l/mrgoodbytes8667/faker-providers?logo=creative-commons&logoColor=FFF&style=flat)
![GitHub Release Workflow Status](https://img.shields.io/github/actions/workflow/status/mrgoodbytes8667/faker-providers/release.yml?label=stable%20build&logo=github&logoColor=FFF&style=flat)
![GitHub Tests Workflow Status](https://img.shields.io/github/actions/workflow/status/mrgoodbytes8667/faker-providers/run-tests.yml?logo=github&logoColor=FFF&style=flat)
![GitHub Coverage Workflow Status](https://img.shields.io/github/actions/workflow/status/mrgoodbytes8667/faker-providers/code-coverage.yml?label=coverage%20build&logo=github&logoColor=FFF&style=flat)
[![codecov](https://img.shields.io/codecov/c/github/mrgoodbytes8667/faker-providers/0.5?logo=codecov&logoColor=FFF&style=flat)](https://codecov.io/gh/mrgoodbytes8667/faker-providers)  
A [Faker](https://fakerphp.github.io/) Factory, Generator, and some providers

## Installation

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Open a command console, enter your project directory and execute:

```console
$ composer require mrgoodbytes8667/faker-providers
```

## Usage

```php
use Bytes\Common\Faker\Factory;

$faker = Factory::create();

$faker->camelWords();
$faker->snakeWords();
$faker->oneOrMoreOf(['some', 'iterable', 'object']);
$faker->rangeBetween(4, 1, 2);
$faker->randomAlphanumericString();
$faker->paragraphsMinimumChars();
```

The included replacement Factory removes the now deprecated Faker image provider and replaces it with the [mmo/faker-images](https://github.com/morawskim/faker-images) provider, and adds other included providers by default. It returns an overloaded Generator for code completion purposes as well.

### With PHPUnit
See [test-common-faker](https://github.com/mrgoodbytes8667/test-common-faker) for easy PHPUnit test integrate

### With Zenstruck/Foundry
Add the following to `Kernel.php` to replace the default Faker Generator with this one, adding in these providers

```php
    public function process(ContainerBuilder $container): void
    {
        $container->getDefinition('.zenstruck_foundry.faker')->setFactory([\Bytes\Common\Faker\Factory::class, 'create']);
    }
```

## License
[![License](https://i.creativecommons.org/l/by-nc/4.0/88x31.png)]("http://creativecommons.org/licenses/by-nc/4.0/)  
Faker Providers by [MrGoodBytes](https://mrgoodbytes.dev) is licensed under a [Creative Commons Attribution-NonCommercial 4.0 International License](http://creativecommons.org/licenses/by-nc/4.0/).  
Based on a work at [https://github.com/mrgoodbytes8667/faker-providers](https://github.com/mrgoodbytes8667/faker-providers).