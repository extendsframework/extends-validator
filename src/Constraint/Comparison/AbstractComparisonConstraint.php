<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractComparisonConstraint extends AbstractConstraint
{
    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ConstraintInterface
    {
        return new static();
    }
}
