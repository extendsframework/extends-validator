<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator;

use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorException;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ContainerValidator;

class ValidatorFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     * @throws ServiceLocatorException
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $container = new ContainerValidator();
        foreach ($extra['validators'] ?? [] as $validator) {
            /** @noinspection PhpParamsInspection */
            $container->addValidator(
                $serviceLocator->getService($validator['name'], $validator['options'] ?? []),
                $validator['interrupt'] ?? null
            );
        }

        return $container;
    }
}
