<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class LessThanConstraint extends AbstractComparisonConstraint
{
    /**
     * When value is not less than context.
     *
     * @const string
     */
    public const NOT_LESS_THAN = 'notLessThan';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ($value < $context) {
            return null;
        }

        return $this->getViolation(self::NOT_LESS_THAN);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_LESS_THAN => 'Value is not less than context.',
        ];
    }
}
