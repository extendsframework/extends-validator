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
     * Identifier for the constraint.
     *
     * @var string
     */
    protected $identifier;

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
     * @param string              $identifier
     * @param bool|null           $interrupt
     */
    public function __construct(ConstraintInterface $constraint, string $identifier, bool $interrupt = null)
    {
        $this->constraint = $constraint;
        $this->interrupt = $interrupt;
        $this->identifier = $identifier ?? false;
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
     * Get identifier for this constraint.
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
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
