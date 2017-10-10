<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;

class ValidatorConstraint
{
    /**
     * The constraint to assert.
     *
     * @var ConstraintInterface
     */
    protected $constraint;

    /**
     * Whether or not the validation must be stopped.
     *
     * @var bool
     */
    protected $interrupt;

    /**
     * Set $constraint and $interrupt flag.
     *
     * @param ConstraintInterface $constraint
     * @param bool                $interrupt
     */
    public function __construct(ConstraintInterface $constraint, bool $interrupt)
    {
        $this->constraint = $constraint;
        $this->interrupt = $interrupt;
    }

    /**
     * Return the constraint.
     *
     * @return ConstraintInterface
     */
    public function getConstraint(): ConstraintInterface
    {
        return $this->constraint;
    }

    /**
     * Return the interrupt flag.
     *
     * @return bool
     */
    public function mustInterrupt(): bool
    {
        return $this->interrupt;
    }
}
