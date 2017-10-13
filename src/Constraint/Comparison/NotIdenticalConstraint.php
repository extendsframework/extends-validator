<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class NotIdenticalConstraint extends AbstractConstraint
{
    /**
     * Key when value is not identical to context.
     *
     * @const string
     */
    public const IS_IDENTICAL = 'identical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ($value !== $context) {
            return null;
        }

        return $this->getViolation(self::IS_IDENTICAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::IS_IDENTICAL => 'Value is identical to context.',
        ];
    }
}
