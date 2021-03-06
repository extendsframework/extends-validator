<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Collection;

use ExtendsFramework\ServiceLocator\ServiceLocatorException;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\Container\ContainerResult;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\IterableValidator;
use ExtendsFramework\Validator\ValidatorInterface;

class ContainsValidator extends AbstractValidator
{
    /**
     * Validator to validate collection values.
     *
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * CollectionValidator constructor.
     *
     * @param ValidatorInterface $validator
     */
    public function __construct(ValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @inheritDoc
     * @throws ServiceLocatorException
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        $validator = $extra['validator'];
        $service = $serviceLocator->getService($validator['name'], $validator['options'] ?? []);

        /**
         * @var ValidatorInterface $service
         */
        return new static($service);
    }

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($collection, $context = null): ResultInterface
    {
        $result = (new IterableValidator())->validate($collection);
        if (!$result->isValid()) {
            return $result;
        }

        $container = new ContainerResult();
        foreach ($collection as $index => $value) {
            $container->addResult(
                $this->validator->validate($value, $context),
                (string)$index
            );
        }

        return $container;
    }

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
