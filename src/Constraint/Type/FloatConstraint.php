<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class FloatConstraint extends AbstractConstraint
{
    /**
     * When value is not a float.
     *
     * @const string
     */
    public const NOT_FLOAT = 'notFloat';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_float($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_FLOAT, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_FLOAT => 'Value must be a float, got "{{type}}".',
        ];
    }
}
