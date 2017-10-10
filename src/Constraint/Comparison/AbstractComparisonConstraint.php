<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractComparisonConstraint extends AbstractConstraint
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
     * @return AbstractComparisonConstraint
     */
    public function addConstraint(ConstraintInterface $constraint): AbstractComparisonConstraint
    {
        $this->constraints[] = $constraint;

        return $this;
    }
}
