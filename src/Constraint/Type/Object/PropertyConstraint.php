<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type\Object;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class PropertyConstraint extends AbstractConstraint
{
    /**
     * When property not exists on class.
     *
     * @const string
     */
    public const NOT_EXISTS = 'notExists';

    /**
     * Object property to check.
     *
     * @var string
     */
    protected $property;

    /**
     * Constraint for property value.
     *
     * @var ConstraintInterface
     */
    protected $constraint;

    /**
     * If property is optional.
     *
     * @var bool
     */
    protected $optional;

    /**
     * PropertyExistsConstraint constructor.
     *
     * @param string              $property
     * @param ConstraintInterface $constraint
     * @param bool|null           $optional
     */
    public function __construct(string $property, ConstraintInterface $constraint, bool $optional = null)
    {
        $this->property = $property;
        $this->constraint = $constraint;
        $this->optional = $optional ?? false;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        $property = $this->property;
        if (property_exists($value, $property) === false) {
            if ($this->optional === false) {
                return $this->getViolation(self::NOT_EXISTS, [
                    'property' => $property,
                ]);
            }

            return null;
        }

        return $this->constraint->validate($value->{$property});
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ConstraintInterface
    {
        $constraint = $extra['constraint'];
        $constraint = $serviceLocator->getService(
            $constraint['name'],
            $constraint['options'] ?? []
        );

        return new static(
            $extra['property'],
            $constraint,
            $extra['optional'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_EXISTS => 'Property "{{property}}" must exists and can not be left empty.',
        ];
    }
}
