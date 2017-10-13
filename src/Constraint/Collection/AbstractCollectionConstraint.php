<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Collection;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;

abstract class AbstractCollectionConstraint extends AbstractConstraint
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
     * @return AbstractCollectionConstraint
     */
    public function addConstraint(ConstraintInterface $constraint): AbstractCollectionConstraint
    {
        $this->constraints[] = $constraint;

        return $this;
    }
}
