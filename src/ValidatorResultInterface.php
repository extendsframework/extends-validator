<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

interface ValidatorResultInterface
{
    /**
     * Return if validation was valid.
     *
     * @return bool
     */
    public function isValid(): bool;

    /**
     * Get validation violations.
     *
     * When validation was valid, array will be empty.
     *
     * @return ConstraintViolationInterface[]
     */
    public function getViolations(): array;
}
