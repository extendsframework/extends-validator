<?php

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;

class ValidatorConstraint
{
    /**
     * @var ConstraintInterface
     */
    protected $constraint;

    /**
     * @var bool
     */
    protected $interrupt;

    /**
     * Set $constraint and $interrupt for the validator constraint.
     *
     * @param ConstraintInterface $constraint
     * @param bool                $interrupt
     */
    public function __construct(ConstraintInterface $constraint, $interrupt = false)
    {
        $this->constraint = $constraint;
        $this->interrupt = (bool)$interrupt;
    }

    /**
     * Return the constraint.
     *
     * @return ConstraintInterface
     */
    public function constraint()
    {
        return $this->constraint;
    }

    /**
     * Return the interrupt flag.
     *
     * @return bool
     */
    public function interrupt()
    {
        return $this->interrupt;
    }
}
