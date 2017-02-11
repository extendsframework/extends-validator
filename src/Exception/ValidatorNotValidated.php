<?php

namespace ExtendsFramework\Validator\Exception;

use LogicException;

class ValidatorNotValidated extends LogicException
{
    /**
     * Exception when validator is not validated yet.
     *
     * @return static
     */
    public static function forViolations()
    {
        $exception = new static('Validator MUST be validated to get violations, call validate() first.');
        return $exception;
    }
}
