<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Loader;

use ExtendsFramework\ServiceLocator\Config\Loader\LoaderInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\Resolver\StaticFactory\StaticFactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Number\EqualValidator;
use ExtendsFramework\Validator\Number\GreaterOrEqualValidator;
use ExtendsFramework\Validator\Number\GreaterThanValidator;
use ExtendsFramework\Validator\Number\IdenticalValidator;
use ExtendsFramework\Validator\Number\LessOrEqualValidator;
use ExtendsFramework\Validator\Number\LessThanValidator;
use ExtendsFramework\Validator\Number\NotEqualValidator;
use ExtendsFramework\Validator\Number\NotIdenticalValidator;
use ExtendsFramework\Validator\Text\RegexValidator;
use ExtendsFramework\Validator\Text\UuidValidator;
use ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator\ValidatorFactory;
use ExtendsFramework\Validator\Logical\AndValidator;
use ExtendsFramework\Validator\Logical\NotValidator;
use ExtendsFramework\Validator\Logical\OrValidator;
use ExtendsFramework\Validator\Logical\XorValidator;
use ExtendsFramework\Validator\Type\ArrayValidator;
use ExtendsFramework\Validator\Type\BooleanValidator;
use ExtendsFramework\Validator\Type\FloatValidator;
use ExtendsFramework\Validator\Type\IntegerValidator;
use ExtendsFramework\Validator\Type\NumericValidator;
use ExtendsFramework\Validator\Type\StringValidator;
use ExtendsFramework\Validator\ValidatorInterface;

class ValidatorConfigLoader implements LoaderInterface
{
    /**
     * @inheritDoc
     */
    public function load(): array
    {
        return [
            ServiceLocatorInterface::class => [
                FactoryResolver::class => [
                    ValidatorInterface::class => ValidatorFactory::class,
                ],
                StaticFactoryResolver::class => [
                    EqualValidator::class => EqualValidator::class,
                    GreaterOrEqualValidator::class => GreaterOrEqualValidator::class,
                    GreaterThanValidator::class => GreaterThanValidator::class,
                    IdenticalValidator::class => IdenticalValidator::class,
                    LessOrEqualValidator::class => LessOrEqualValidator::class,
                    LessThanValidator::class => LessThanValidator::class,
                    NotEqualValidator::class => NotEqualValidator::class,
                    NotIdenticalValidator::class => NotIdenticalValidator::class,
                    RegexValidator::class => RegexValidator::class,
                    UuidValidator::class => UuidValidator::class,
                    AndValidator::class => AndValidator::class,
                    NotValidator::class => NotValidator::class,
                    OrValidator::class => OrValidator::class,
                    XorValidator::class => XorValidator::class,
                    ArrayValidator::class => ArrayValidator::class,
                    BooleanValidator::class => BooleanValidator::class,
                    FloatValidator::class => FloatValidator::class,
                    IntegerValidator::class => IntegerValidator::class,
                    NumericValidator::class => NumericValidator::class,
                    StringValidator::class => StringValidator::class,
                ],
            ],
        ];
    }
}
