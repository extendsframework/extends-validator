# ExtendsFramework\Validator
[![Build Status](https://travis-ci.org/extendsframework/extends-validator.svg?branch=master)](https://travis-ci.org/extendsframework/extends-validator)
[![Coverage Status](https://coveralls.io/repos/github/extendsframework/extends-validator/badge.svg?branch=master)](https://coveralls.io/github/extendsframework/extends-validator?branch=master)
[![License](https://poser.pugx.org/extendsframework/extends-validator/license)](https://packagist.org/packages/extendsframework/extends-validator)
[![Latest Stable Version](https://poser.pugx.org/extendsframework/extends-validator/v/stable)](https://packagist.org/packages/extendsframework/extends-validator)
[![Total Downloads](https://poser.pugx.org/extendsframework/extends-validator/downloads)](https://packagist.org/packages/extendsframework/extends-validator)

This repository provides a set of validators to validate data and data structures.

## Installation

You can install ExtendsFramework\Validator into your project using [Composer](https://getcomposer.org).
 
```bash
$ composer require extendsframework/extends-validator
```

## Example

An simple example to give an idea how to use a validator.

```php
<?php
declare(strict_types=1);

require 'vendor/autoload.php';

use ExtendsFramework\Validator\Text\LengthValidator;

echo json_encode(
    (new LengthValidator(5, 10))
        ->validate('Hello world!')
        ->isValid()
);

// Will output false, string is 13 characters long.
```

## Documentation

The documentation for ExtendsFramework\Validator is available on the
[Github Wiki](https://github.com/extendsframework/extends-validator/wiki).

## Issues

Bug reports and feature requests can be submitted on the
[Github Issue Tracker](https://github.com/extendsframework/extends-validator/issues).
