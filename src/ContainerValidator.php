<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Container\ContainerInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

class ContainerValidator implements ContainerValidatorInterface
{
    /**
     *
     *
     * @var ValidatorInterface[]
     */
    protected $validators = [];

    /**
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
