<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator;

use ExtendsFramework\ServiceLocator\Resolver\Factory\ServiceFactoryInterface;
use ExtendsFramework\ServiceLocator\ServiceLocatorException;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ContainerValidator;
use ExtendsFramework\Validator\ValidatorInterface;

class ValidatorFactory implements ServiceFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createService(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $container = new ContainerValidator();
        foreach ($extra['validators'] ?? [] as $validator) {
            $container->addValidator(
                $this->getValidator($serviceLocator, $validator['name'], $validator['options'] ?? []),
                $validator['interrupt'] ?? false
            );
        }

        return $container;
    }

    /**
     * Get validator for name.
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @param string                  $name
     * @param array                   $options
     * @return ValidatorInterface
     * @throws ServiceLocatorException
     */
    private function getValidator(ServiceLocatorInterface $serviceLocator, string $name, array $options): object
    {
        return $serviceLocator->getService($name, $options);
    }
}
