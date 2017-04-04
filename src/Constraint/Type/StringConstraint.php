<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;

class StringConstraint extends AbstractConstraint
{
    /**
     * Key when value is not a string.
     *
     * @const string
     */
    const NOT_STRING = 'notString';

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null): void
    {
        if (!is_string($value)) {
            throw $this->getViolation(self::NOT_STRING, [
                'type' => gettype($value),
            ]);
        }
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_STRING => 'Value must be a string, got "{{type}}".',
        ];
    }
}
