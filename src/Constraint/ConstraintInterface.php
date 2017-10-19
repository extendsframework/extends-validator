<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

interface ConstraintInterface
{
    /**
     * Validate $value and, optional, $context against constraint.
     *
     * When validation is successful, null will be returned.
     *
     * @param mixed $value
     * @param mixed $context
     * @return null|ConstraintViolationInterface
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface;

    /**
     * Create constraint from $config.
     *
     * @param array $config
     * @return ConstraintInterface
     */
    public static function factory(array $config): ConstraintInterface;
}
