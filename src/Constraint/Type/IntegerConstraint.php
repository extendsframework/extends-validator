<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class IntegerConstraint extends AbstractTypeConstraint
{
    /**
     * When value is not an integer.
     *
     * @const string
     */
    public const NOT_INTEGER = 'notInteger';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_int($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_INTEGER, [
            'type' => gettype($value),
        ]);
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
