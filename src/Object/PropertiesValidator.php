<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Object;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Object\Properties\Property;
use ExtendsFramework\Validator\Result\Container\ContainerResult;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\ObjectValidator;
use ExtendsFramework\Validator\ValidatorInterface;

class PropertiesValidator extends AbstractValidator
{
    /**
     * WHen property is not allowed.
     *
     * @var string
     */
    public const PROPERTY_NOT_ALLOWED = 'propertyNotAllowed';

    /**
     * When property is missing.
     *
     * @var string
     */
    public const PROPERTY_MISSING = 'propertyMissing';

    /**
     * Properties to validate.
     *
     * @var Property[]
     */
    protected $properties = [];

    /**
     * If only defined properties are allowed.
     *
     * @var bool
     */
    protected $strict;

    /**
     * ObjectPropertiesValidator constructor.
     *
     * @param array|null $properties
     * @param bool|null  $strict
     */
    public function __construct(array $properties = null, bool $strict = null)
    {
        foreach ($properties ?? [] as $property => $validator) {
            if (is_array($validator) === true) {
                [$validator, $optional] = $validator;
            }

            $this->addProperty($property, $validator, $optional ?? null);
        }

        $this->strict = $strict ?? true;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): PropertiesValidator
    {
        $properties = new static(
            null,
            $extra['strict'] ?? null
        );

        foreach ($extra['properties'] ?? [] as $property) {
            $validator = $property['validator'];

            $properties->addProperty(
                $property['property'],
                $serviceLocator->getService(
                    $validator['name'],
                    $validator['options'] ?? []
                ),
                $property['optional'] ?? null
            );
        }

        return $properties;
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $result = (new ObjectValidator())->validate($value, $context);
        if ($result->isValid() === false) {
            return $result;
        }

        $container = new ContainerResult();
        foreach ($this->properties as $property) {
            $name = $property->getName();
            if (property_exists($value, $name) === false) {
                if ($property->isOptional() === false) {
                    $container->addResult(
                        $this->getInvalidResult(self::PROPERTY_MISSING, [
                            'property' => $name,
                        ]),
                        $name
                    );
                }

                continue;
            }

            $container->addResult(
                $property
                    ->getValidator()
                    ->validate($value->{$name}, $context),
                $name
            );
        }

        if ($this->strict === true) {
            $this->checkStrictness($container, $value);
        }

        return $container;
    }

    /**
     * Add $validator for $property.
     *
     * An existing validator for $property will be overwritten.
     *
     * @param string             $property
     * @param ValidatorInterface $validator
     * @param bool|null          $optional
     * @return PropertiesValidator
     */
    public function addProperty(string $property, ValidatorInterface $validator, bool $optional = null): PropertiesValidator
    {
        $this->properties[$property] = new Property($property, $validator, $optional);

        return $this;
    }

    /**
     * Check strictness.
     *
     * If in strict mode, check if there more than the allowed properties.
     *
     * @param ContainerResult $container
     * @param mixed           $object
     * @return void
     * @throws TemplateNotFound
     */
    protected function checkStrictness(ContainerResult $container, $object): void
    {
        foreach ($object as $property => $value) {
            if (array_key_exists($property, $this->properties) === false) {
                $container->addResult(
                    $this->getInvalidResult(self::PROPERTY_NOT_ALLOWED, [
                        'property' => $property,
                    ]),
                    $property
                );
            }
        }
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::PROPERTY_NOT_ALLOWED => 'Property \'{{property}}\' is not allowed on object.',
            self::PROPERTY_MISSING => 'Property \'{{property}}\' is missing and can not be left empty.',
        ];
    }
}
