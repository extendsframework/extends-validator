<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

interface ValidatorInterface
{
    /**
     * Validate $value and, optional, $context against constraints.
     *
     * The $context will be passed to the current constraint that is asserted. When validation is successful, true
     * will be returned. False otherwise.
     *
     * @param mixed $value
     * @param mixed $context
     * @return bool
     */
    public function validate($value, $context = null): bool;

    /**
     * Returns list with constraint violations after validation.
     *
     * If validation has not happened yet, an exception will be thrown.
     *
     * @return ConstraintViolation[]
     * @throws ValidatorException
     */
    public function violations(): array;
}
