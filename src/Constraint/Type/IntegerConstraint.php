<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;

class IntegerConstraint extends AbstractConstraint
{
    /**
     * Key when value is not an integer.
     *
     * @const string
     */
    const NOT_INTEGER = 'notInteger';

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null): void
    {
        if (!\is_int($value)) {
            throw $this->getViolation(self::NOT_INTEGER, [
                'type' => \gettype($value),
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_INTEGER => 'Value must be a integer, got "{{type}}".',
        ];
    }
}
