<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintException;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

class Validator implements ValidatorInterface
{
    /**
     * Indexed array with validator constraints to use for validation.
     *
     * @var ValidatorConstraint[]
     */
    protected $constraints = [];

    /**
     * Indexed array which contains the violations after validating.
     *
     * @var ConstraintViolation[]
     */
    protected $violations = [];

    /**
     * @inheritdoc
     */
    public function validate($value, $context = null): bool
    {
        $this->violations = [];

        foreach ($this->constraints as $constraint) {
            try {
                $constraint->constraint()->assert($value, $context);
            } catch (ConstraintException $violation) {
                $this->violations[] = $violation;

                if ($constraint->interrupt()) {
                    break;
                }
            }
        }

        return empty($this->violations);
    }

    /**
     * @inheritDoc
     */
    public function violations(): array
    {
        return $this->violations;
    }

    /**
     * Add constraint to validator.
     *
     * @param ConstraintInterface $constraint
     * @param bool                $interrupt
     * @return Validator
     */
    public function add(ConstraintInterface $constraint, bool $interrupt = null): Validator
    {
        $this->constraints[] = new ValidatorConstraint($constraint, $interrupt);

        return $this;
    }
}
