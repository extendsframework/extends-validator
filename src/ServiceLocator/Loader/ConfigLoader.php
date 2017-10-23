<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\ServiceLocator\Loader;

use ExtendsFramework\ServiceLocator\Config\Loader\LoaderInterface;
use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\Resolver\StaticFactory\StaticFactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\Comparison\EqualConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\GreaterOrEqualConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\GreaterThanConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\IdenticalConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\LessOrEqualConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\LessThanConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\NotEqualConstraint;
use ExtendsFramework\Validator\Constraint\Comparison\NotIdenticalConstraint;
use ExtendsFramework\Validator\Constraint\Format\RegexConstraint;
use ExtendsFramework\Validator\Constraint\Format\UuidConstraint;
use ExtendsFramework\Validator\Constraint\Logical\AndConstraint;
use ExtendsFramework\Validator\Constraint\Logical\NotConstraint;
use ExtendsFramework\Validator\Constraint\Logical\OrConstraint;
use ExtendsFramework\Validator\Constraint\Logical\XorConstraint;
use ExtendsFramework\Validator\Constraint\Type\BooleanConstraint;
use ExtendsFramework\Validator\Constraint\Type\FloatConstraint;
use ExtendsFramework\Validator\Constraint\Type\IntegerConstraint;
use ExtendsFramework\Validator\Constraint\Type\StringConstraint;
use ExtendsFramework\Validator\ServiceLocator\Factory\ValidatorFactory;
use ExtendsFramework\Validator\ValidatorInterface;

class ConfigLoader implements LoaderInterface
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
                    EqualConstraint::class => EqualConstraint::class,
                    GreaterOrEqualConstraint::class => GreaterOrEqualConstraint::class,
                    GreaterThanConstraint::class => GreaterThanConstraint::class,
                    IdenticalConstraint::class => IdenticalConstraint::class,
                    LessOrEqualConstraint::class => LessOrEqualConstraint::class,
                    LessThanConstraint::class => LessThanConstraint::class,
                    NotEqualConstraint::class => NotEqualConstraint::class,
                    NotIdenticalConstraint::class => NotIdenticalConstraint::class,
                    RegexConstraint::class => RegexConstraint::class,
                    UuidConstraint::class => UuidConstraint::class,
                    AndConstraint::class => AndConstraint::class,
                    NotConstraint::class => NotConstraint::class,
                    OrConstraint::class => OrConstraint::class,
                    XorConstraint::class => XorConstraint::class,
                    BooleanConstraint::class => BooleanConstraint::class,
                    FloatConstraint::class => FloatConstraint::class,
                    IntegerConstraint::class => IntegerConstraint::class,
                    StringConstraint::class => StringConstraint::class,
                ],
            ],
        ];
    }
}
