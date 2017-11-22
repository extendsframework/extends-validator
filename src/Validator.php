<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;

class Validator implements ValidatorInterface
{
    /**
     * Indexed array with validator constraints to use for validation.
     *
     * @var ValidatorConstraint[]
     */
    protected $constraints = [];

    /**
     * @inheritdoc
     */
    public function validate($value, $context = null): ValidatorResultInterface
    {
        $valid = true;
        $violations = [];
        foreach ($this->constraints as $constraint) {
            $violation = $constraint->getConstraint()->validate($value, $context);
            if ($violation instanceof ConstraintViolationInterface) {
                $valid = false;
                $violations[$constraint->getIdentifier()] = $violation;

                if ($constraint->mustInterrupt() === true) {
                    break;
                }
            }
        }

        return new ValidatorResult($valid, $violations);
    }

    /**
     * Add $constraint to validator.
     *
     * When $interrupt is true, validation will stop if $constraint is invalid. Default value is false.
     *
     * @param ConstraintInterface $constraint
     * @param string|null         $identifier
     * @param bool|null           $interrupt
     * @return Validator
     */
    public function addConstraint(ConstraintInterface $constraint, string $identifier, bool $interrupt = null): Validator
    {
        $this->constraints[] = new ValidatorConstraint($constraint, $identifier, $interrupt);

        return $this;
    }
}
