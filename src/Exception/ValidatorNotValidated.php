<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Exception;

use ExtendsFramework\Validator\ValidatorException;

class ValidatorNotValidated extends ValidatorException
{
    /**
     * Returns a new instance when container validate is not validated.
     *
     * @return ValidatorException
     */
    public static function forContainer(): ValidatorException
    {
        return new static('Container validator MUST be validated. Call validate() first.');
    }
}
