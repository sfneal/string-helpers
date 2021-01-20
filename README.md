# String Helpers

[![Packagist PHP support](https://img.shields.io/packagist/php-v/sfneal/string-helpers)](https://packagist.org/packages/sfneal/string-helpers)
[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/string-helpers.svg?style=flat-square)](https://packagist.org/packages/sfneal/string-helpers)
[![Build Status](https://travis-ci.com/sfneal/string-helpers.svg?branch=master&style=flat-square)](https://travis-ci.com/sfneal/string-helpers)
[![StyleCI](https://github.styleci.io/repos/288787695/shield?branch=master)](https://github.styleci.io/repos/288787695?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/sfneal/string-helpers/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/sfneal/string-helpers/?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/string-helpers.svg?style=flat-square)](https://packagist.org/packages/sfneal/string-helpers)

PHP string helper functions that add familiar functionality from other languages (like string contains, splitting, truncating, etc...)

## Installation

You can install the package via composer:

```bash
composer require sfneal/string-helpers
```

In order to autoload to the helper functions add the following path to the autoload.files section in your composer.json. 

```json
"autoload": {
    "files": [
        "vendor/sfneal/string-helpers/src/strings.php"
    ]
},
```

## Usage

Example use of the 'truncate' helper and method.

``` php
# using StringHelpers import
use Sfneal\Helpers\Strings\StringHelpers;
(new StringHelpers("here is a long string we'd like to truncate"))->truncate(12);
>>> here is a lo...


# using autloaded helpers
truncateString("here is a long string we'd like to truncate", 12);
>>> here is a lo...
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

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
