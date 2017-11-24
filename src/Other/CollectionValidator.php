<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Result\Container\ContainerResult;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\IterableValidator;
use ExtendsFramework\Validator\ValidatorInterface;

class CollectionValidator extends AbstractValidator
{
    /**
     * Validator to validate collection values.
     *
     * @var ValidatorInterface
     */
    protected $validator;

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
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): CollectionValidator
    {
        $validator = $extra['validator'];

        return new static(
            $serviceLocator->getService($validator['name'], $validator['options'] ?? [])
        );
    }

    /**
     * @inheritDoc
     */
    public function validate($collection, $context = null): ResultInterface
    {
        $result = (new IterableValidator())->validate($collection);
        if ($result->isValid() === false) {
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
