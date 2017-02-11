<?php

namespace ExtendsFramework\Validator\Constraint;

use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

interface ConstraintInterface
{
    /**
     * Assert $value against constraint.
     *
     * When assertion fails, an exception will be thrown.
     *
     * @param mixed $value
     * @param null  $context
     * @throws ConstraintViolation
     * @return true
     */
    public function assert($value, $context = null);

    /**
     * Validate $value against constraint.
     *
     * When validation fails, false will be returned, true otherwise.
     *
     * @param mixed $value
     * @param null  $context
     * @return bool
     */
    public function validate($value, $context = null);
}
