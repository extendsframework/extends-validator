<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractTypeConstraint extends AbstractConstraint
{
    /**
     * @inheritDoc
     */
    public static function factory(array $config): ConstraintInterface
    {
        return new static();
    }
}
