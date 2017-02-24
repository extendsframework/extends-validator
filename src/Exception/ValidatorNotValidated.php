<?php

namespace ExtendsFramework\Validator\Exception;

use ExtendsFramework\Validator\ValidatorException;

class ValidatorNotValidated extends ValidatorException
{
    /**
     * Exception when validator is not validated yet.
     *
     * @return static
     */
    public static function forViolations()
    {
        return new static('Validator MUST be validated to get violations, call validate() first.');
    }
}
