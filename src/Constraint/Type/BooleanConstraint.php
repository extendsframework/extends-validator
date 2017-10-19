<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class BooleanConstraint extends AbstractTypeConstraint
{
    /**
     * When value is not a boolean.
     *
     * @const string
     */
    public const NOT_BOOLEAN = 'notBoolean';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_bool($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_BOOLEAN, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_BOOLEAN => 'Value must be a boolean, got "{{type}}".',
        ];
    }
}
