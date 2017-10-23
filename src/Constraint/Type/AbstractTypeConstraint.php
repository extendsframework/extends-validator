<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractTypeConstraint extends AbstractConstraint
{
    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ConstraintInterface
    {
        return new static();
    }
}
