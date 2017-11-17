<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class NumericConstraint extends AbstractTypeConstraint
{
    /**
     * When value is not numeric.
     *
     * @const string
     */
    public const NOT_NUMERIC = 'notNumeric';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_numeric($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_NUMERIC, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_NUMERIC => 'Value must be a number, got "{{type}}".',
        ];
    }
}
