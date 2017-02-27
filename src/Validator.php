<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintException;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;
use ExtendsFramework\Validator\Exception\ValidatorNotValidated;

class Validator implements ValidatorInterface
{
    /**
     * @var ValidatorConstraint[]
     */
    protected $constraints = [];

    /**
     * @var ConstraintViolation[]
     */
    protected $violations = [];

    /**
     * @var bool
     */
    protected $validated = false;

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

        $this->validated = true;

        return empty($this->violations);
    }

    /**
     * @inheritDoc
     */
    public function violations(): array
    {
        if (!$this->validated) {
            throw ValidatorNotValidated::forViolations();
        }

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
