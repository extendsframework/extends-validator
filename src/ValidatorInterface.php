<?php

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;
use ExtendsFramework\Validator\Exception\ValidatorNotValidated;

interface ValidatorInterface
{
    /**
     * Validate $value against constraints.
     *
     * The $context will be passed to the current constraint that is asserted. When validation is successful, true
     * will be returned. False otherwise.
     *
     * @param mixed $value
     * @param mixed $context
     * @return bool
     */
    public function validate($value, $context = null);

    /**
     * Returns list with constraint violations after validation.
     *
     * If validation has not happened yet, an exception will be thrown.
     *
     * @throws ValidatorNotValidated
     * @return ConstraintViolation[]
     */
    public function violations();
}
