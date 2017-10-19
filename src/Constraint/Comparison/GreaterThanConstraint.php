<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class GreaterThanConstraint extends AbstractComparisonConstraint
{
    /**
     * When value is not greater than context.
     *
     * @const string
     */
    public const NOT_GREATER_THAN = 'notGreaterThan';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ($value > $context) {
            return null;
        }

        return $this->getViolation(self::NOT_GREATER_THAN);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_GREATER_THAN => 'Value is not greater than context.',
        ];
    }
}
