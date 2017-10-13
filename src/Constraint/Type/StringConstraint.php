<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class StringConstraint extends AbstractConstraint
{
    /**
     * When value is not a string.
     *
     * @const string
     */
    public const NOT_STRING = 'notString';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (is_string($value) === true) {
            return null;
        }

        return $this->getViolation(self::NOT_STRING, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_STRING => 'Value must be a string, got "{{type}}".',
        ];
    }
}
