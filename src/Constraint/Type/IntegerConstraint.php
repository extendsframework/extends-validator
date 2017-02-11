<?php

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
     * Violation templates.
     *
     * @var array
     */
    protected $templates = [
        self::NOT_INTEGER => 'Value must be a integer, got "{{type}}".',
    ];

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null)
    {
        if (!is_int($value)) {
            $violation = $this->violate(self::NOT_INTEGER, [
                'type' => gettype($value),
            ]);
            throw $violation;
        }
        return true;
    }
}
