<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class LessOrEqualConstraint extends AbstractConstraint
{
    /**
     * When value is not less than or equal to context.
     *
     * @const string
     */
    public const NOT_LESS_OR_EQUAL = 'notLessOrEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ($value <= $context) {
            return null;
        }

        return $this->getViolation(self::NOT_LESS_OR_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_LESS_OR_EQUAL => 'Value is not less than or equal to context.',
        ];
    }
}
