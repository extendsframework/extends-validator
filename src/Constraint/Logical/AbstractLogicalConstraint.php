<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractLogicalConstraint extends AbstractConstraint
{
    /**
     * Constraints to validate.
     *
     * @var ConstraintInterface[]
     */
    protected $constraints = [];

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ConstraintInterface
    {
        $instance = new static();
        foreach ($extra['constraints'] ?? [] as $constraint) {
            $instance->addConstraint(
                $serviceLocator->getService($constraint['name'], $constraint['options'] ?? [])
            );
        }

        return $instance;
    }

    /**
     * Add $constraint.
     *
     * @param ConstraintInterface $constraint
     * @return AbstractLogicalConstraint
     */
    public function addConstraint(ConstraintInterface $constraint): AbstractLogicalConstraint
    {
        $this->constraints[] = $constraint;

        return $this;
    }
}
