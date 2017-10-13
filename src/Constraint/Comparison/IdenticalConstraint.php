<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class IdenticalConstraint extends AbstractConstraint
{
    /**
     * When value is not identical to context.
     *
     * @const string
     */
    public const NOT_IDENTICAL = 'notIdentical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if ($value === $context) {
            return null;
        }

        return $this->getViolation(self::NOT_IDENTICAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_IDENTICAL => 'Value is not identical to context.',
        ];
    }
}
