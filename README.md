# Laravel SMS123 API Integration package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/cyaoz94/sms123.svg?style=flat-square)](https://packagist.org/packages/cyaoz94/sms123)
[![Build Status](https://img.shields.io/travis/cyaoz94/sms123/master.svg?style=flat-square)](https://travis-ci.org/cyaoz94/sms123)
[![Quality Score](https://img.shields.io/scrutinizer/g/cyaoz94/sms123.svg?style=flat-square)](https://scrutinizer-ci.com/g/cyaoz94/sms123)
[![Total Downloads](https://img.shields.io/packagist/dt/cyaoz94/sms123.svg?style=flat-square)](https://packagist.org/packages/cyaoz94/sms123)

A simple package to simplify API integration with SMS Provider SMS123 for Laravel 8

## Installation

You can install the package via composer:

```bash
composer require cyaoz94/sms123
```

## Configs
You can publish and modify the config file to specify your own apiKey and email values

``` php
php artisan vendor:publish --provider="Cyaoz94\Sms123\Sms123ServiceProvider" --tag="config"
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email casperyaoz@gmail.com instead of using the issue tracker.

## Credits

- [Casper Ho](https://github.com/cyaoz94)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
