<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Container\ContainerInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

class ContainerValidator implements ContainerValidatorInterface
{
    /**
     * Associative array with validators.
     *
     * Key is the path to validate. A path can contain only one validator.
     *
     * @var ValidatorInterface[]
     */
    protected $validators = [];

    /**
     * Associative array which holds the violations after validating.
     *
     * Key is the validated path. Key can contain multiple violations.
     *
     * @var ConstraintViolation[][]
     */
    protected $violations = [];

    /**
     * @inheritDoc
     */
    public function validate(ContainerInterface $container): bool
    {
        $this->violations = [];

        foreach ($this->validators as $path => $validator) {
            $value = $container->find($path, null);
            if (!$validator->validate($value, $container)) {
                $this->violations[$path] = $validator->violations();
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
     * Add $validator for $path.
     *
     * Any existing validator for $path will be overwritten.
     *
     * @param ValidatorInterface $validator
     * @param string             $path
     * @return ContainerValidator
     */
    public function addValidator(ValidatorInterface $validator, string $path): ContainerValidator
    {
        $this->validators[$path] = $validator;

        return $this;
    }
}
