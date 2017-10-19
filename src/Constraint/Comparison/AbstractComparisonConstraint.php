<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractComparisonConstraint extends AbstractConstraint
{
    /**
     * @inheritDoc
     */
    public static function factory(array $config): ConstraintInterface
    {
        return new static();
    }
}
