<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\ValidatorInterface;

abstract class AbstractLogicalValidator extends AbstractValidator
{
    /**
     * Validators to validate.
     *
     * @var ValidatorInterface[]
     */
    protected $validators = [];

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ValidatorInterface
    {
        $instance = new static();
        foreach ($extra['validators'] ?? [] as $validator) {
            $instance->addValidator(
                $serviceLocator->getService($validator['name'], $validator['options'] ?? [])
            );
        }

        return $instance;
    }

    /**
     * Add $validator.
     *
     * @param ValidatorInterface $validator
     * @return AbstractLogicalValidator
     */
    public function addValidator(ValidatorInterface $validator): AbstractLogicalValidator
    {
        $this->validators[] = $validator;

        return $this;
    }
}
