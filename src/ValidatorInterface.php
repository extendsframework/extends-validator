<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Result\ResultInterface;

interface ValidatorInterface
{
    /**
     * Validate $value and, optional, $context against validators.
     *
     * The $context will be passed to the current validator that is asserted.
     *
     * @param mixed $value
     * @param mixed $context
     * @return ResultInterface
     */
    public function validate($value, $context = null): ResultInterface;
}
