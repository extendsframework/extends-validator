<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class GreaterOrEqualConstraint extends AbstractConstraint
{
    /**
     * When value is not greater than or equal to context.
     *
     * @const string
     */
    public const NOT_GREATER_OR_EQUAL = 'notGreaterOrEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ($value >= $context) {
            return null;
        }

        return $this->getViolation(self::NOT_GREATER_OR_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_GREATER_OR_EQUAL => 'Value is not greater than or equal to context.',
        ];
    }
}
