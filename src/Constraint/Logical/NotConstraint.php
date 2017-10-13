<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class NotConstraint extends AbstractLogicalConstraint
{
    /**
     * When value is not false.
     *
     * @const string
     */
    public const NOT_FALSE = 'notFalse';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (!$value) {
            return null;
        }

        return $this->getViolation(self::NOT_FALSE);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_FALSE => 'Value is not equal to false.',
        ];
    }
}
