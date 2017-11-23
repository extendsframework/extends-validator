<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator;

use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ContainerValidator;
use ExtendsFramework\Validator\ValidatorInterface;

class ValidatorFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): ValidatorInterface
    {
        $container = new ContainerValidator();
        foreach ($extra['validators'] ?? [] as $validator) {
            $container->addValidator(
                $serviceLocator->getService($validator['name'], $validator['options'] ?? []),
                $validator['interrupt'] ?? false
            );
        }

        return $container;
    }
}
