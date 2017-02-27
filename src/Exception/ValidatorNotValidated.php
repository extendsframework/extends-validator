<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Exception;

use ExtendsFramework\Validator\ValidatorException;

class ValidatorNotValidated extends ValidatorException
{
    /**
     * Exception when validator is not validated yet.
     *
     * @return ValidatorException
     */
    public static function forViolations(): ValidatorException
    {
        return new static('Validator MUST be validated to get violations, call validate() first.');
    }
}
