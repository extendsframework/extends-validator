<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

interface ValidatorInterface
{
    /**
     * Validate $value and, optional, $context against constraints.
     *
     * The $context will be passed to the current constraint that is asserted.
     *
     * @param mixed $value
     * @param mixed $context
     * @return ValidatorResultInterface
     */
    public function validate($value, $context = null): ValidatorResultInterface;
}
