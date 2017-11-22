<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class ObjectConstraint extends AbstractTypeConstraint
{
    /**
     * When value is not an object.
     *
     * @const string
     */
    public const NOT_OBJECT = 'notObject';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_object($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_OBJECT, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_OBJECT => 'Value must be an object, got "{{type}}".',
        ];
    }
}
