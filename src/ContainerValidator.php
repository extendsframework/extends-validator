<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Container\Container;
use ExtendsFramework\Container\ContainerInterface;
use ExtendsFramework\Validator\Exception\ValidatorNotValidated;

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
     * @var ContainerInterface
     */
    protected $violations;

    /**
     * If validator is validated.
     *
     * @var bool
     */
    protected $validated = false;

    /**
     * @inheritDoc
     */
    public function validate(ContainerInterface $container): bool
    {
        $this->violations = new Container();
        $this->validated = true;

        foreach ($this->validators as $path => $validator) {
            $value = $container->find($path, null);
            if (!$validator->validate($value, $container)) {
                $this->violations = $this->violations->with($path, $validator->violations());
            }
        }

        return $this->violations->isEmpty();
    }

    /**
     * @inheritDoc
     */
    public function violations(): ContainerInterface
    {
        if (!$this->validated) {
            throw ValidatorNotValidated::forContainer();
        }

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
