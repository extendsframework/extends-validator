<?php

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
     * Violation templates.
     *
     * @var array
     */
    protected $templates = [
        self::NOT_STRING => 'Value must be a string, got "{{type}}".',
    ];

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null)
    {
        if (!is_string($value)) {
            $violation = $this->violate(self::NOT_STRING, [
                'type' => gettype($value),
            ]);
            throw $violation;
        }
        return true;
    }
}
