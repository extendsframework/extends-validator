<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class ArrayConstraint extends AbstractTypeConstraint
{
    /**
     * When value is not an array.
     *
     * @const string
     */
    public const NOT_ARRAY = 'notArray';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_array($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_ARRAY, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_ARRAY => 'Value must be an array, got "{{type}}".',
        ];
    }
}
