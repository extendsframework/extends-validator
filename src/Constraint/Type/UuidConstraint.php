<?php

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;

class UuidConstraint extends AbstractConstraint
{
    /**
     * Key when value is not an UUID.
     *
     * @const string
     */
    const NOT_UUID = 'notUuid';

    /**
     * Violation templates.
     *
     * @var array
     */
    protected $templates = [
        self::NOT_UUID => 'Value {{value}} must be a valid UUID.',
    ];

    /**
     * UUID regular expression.
     *
     * @var string
     */
    protected $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';

    /**
     * @inheritDoc
     */
    public function assert($value, $context = null)
    {
        if (!preg_match($this->pattern, $value)) {
            $violation = $this->violate(self::NOT_UUID, [
                'value' => $value,
            ]);
            throw $violation;
        }
        return true;
    }
}
