<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class NotEqualConstraint extends AbstractConstraint
{
    /**
     * When value is not equal to context.
     *
     * @const string
     */
    public const IS_EQUAL = 'equal';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($value != $context) {
            return null;
        }

        return $this->getViolation(self::IS_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::IS_EQUAL => 'Value is equal to context.',
        ];
    }
}
