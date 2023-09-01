# MoneyToNumbers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/logicinception/moneytonumbers.svg?style=flat-square)](https://packagist.org/packages/logicinception/moneytonumbers)
[![Total Downloads](https://img.shields.io/packagist/dt/logicinception/moneytonumbers.svg?style=flat-square)](https://packagist.org/packages/logicinception/moneytonumbers)

Package developed to convert money text on numbers

## Installation

You can install the package via composer:

```bash
composer require logicinception/moneytonumbers
```

## Usage

```php
$textClass = new TextToNumber("dois mil quinhentos e vinte e três reais e dezoito centavos");
$textClass->getNumber(); //output: 2523,18
```

### Testing

```bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

### Security

If you discover any security related issues, please email dev.mengue@gmail.com or itamar.brito@gmail.com instead of using the issue tracker.

## Credits

-   [Wagner Mengue](https://github.com/wagnermengue)
-   [Itamar Brito](https://github.com/Itamar-Brito)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.