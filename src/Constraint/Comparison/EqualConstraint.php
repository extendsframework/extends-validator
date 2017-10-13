<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class EqualConstraint extends AbstractConstraint
{
    /**
     * Key when value is not equal to context.
     *
     * @const string
     */
    public const NOT_EQUAL = 'notEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($value == $context) {
            return null;
        }

        return $this->getViolation(self::NOT_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_EQUAL => 'Value is not equal to context.',
        ];
    }
}
