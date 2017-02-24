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
            throw $this->getViolation(self::NOT_UUID, [
                'value' => $value,
            ]);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates()
    {
        return [
            self::NOT_UUID => 'Value {{value}} must be a valid UUID.',
        ];
    }
}
