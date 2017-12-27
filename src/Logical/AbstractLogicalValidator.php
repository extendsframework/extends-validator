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
     * AbstractLogicalValidator constructor.
     *
     * @param array|null $validators
     */
    public function __construct(array $validators = null)
    {
        foreach ($validators ?? [] as $validator) {
            $this->addValidator($validator);
        }
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $validators = [];
        foreach ($extra['validators'] ?? [] as $validator) {
            $validators[] = $serviceLocator->getService($validator['name'], $validator['options'] ?? []);
        }

        return new static($validators);
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
