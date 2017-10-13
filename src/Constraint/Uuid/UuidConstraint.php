<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Uuid;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class UuidConstraint extends AbstractConstraint
{
    /**
     * Key when value is not an UUID.
     *
     * @const string
     */
    public const NOT_UUID = 'notUuid';

    /**
     * UUID regular expression.
     *
     * @var string
     */
    protected $pattern = '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        if (preg_match($this->pattern, $value) === 1) {
            return null;
        }

        return $this->getViolation(self::NOT_UUID, [
            'value' => $value,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_UUID => 'Value "{{value}}" must be a valid UUID.',
        ];
    }
}
