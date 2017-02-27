<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint;

interface ConstraintInterface
{
    /**
     * Assert $value and, optional, $context against constraint.
     *
     * When assertion fails, an exception will be thrown, true will be returned otherwise.
     *
     * @param mixed $value
     * @param mixed $context
     * @return void
     * @throws ConstraintException
     */
    public function assert($value, $context = null): void;

    /**
     * Validate $value and, optional, $context against constraint.
     *
     * When validation fails, false will be returned, true otherwise.
     *
     * @param mixed $value
     * @param mixed $context
     * @return bool
     */
    public function validate($value, $context = null): bool;
}
