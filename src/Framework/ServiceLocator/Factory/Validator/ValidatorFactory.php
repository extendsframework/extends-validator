<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator;

use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Validator;
use ExtendsFramework\Validator\ValidatorInterface;

class ValidatorFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ValidatorInterface
    {
        $validator = new Validator();
        foreach ($extra['constraints'] ?? [] as $constraint) {
            $validator->addConstraint(
                $serviceLocator->getService($constraint['name'], $constraint['options'] ?? []),
                $constraint['interrupt'] ?? false
            );
        }

        return $validator;
    }
}
