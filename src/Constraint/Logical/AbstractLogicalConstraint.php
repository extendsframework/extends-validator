<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

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
