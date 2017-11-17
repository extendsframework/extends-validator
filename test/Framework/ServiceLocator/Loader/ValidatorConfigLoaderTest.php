<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Loader;

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
use ExtendsFramework\Validator\Constraint\Type\NumericConstraint;
use ExtendsFramework\Validator\Constraint\Type\StringConstraint;
use ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator\ValidatorFactory;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class ValidatorConfigLoaderTest extends TestCase
{
    /**
     * Load.
     *
     * Test that load method returns correct config.
     *
     * @covers \ExtendsFramework\Validator\Framework\ServiceLocator\Loader\ValidatorConfigLoader::load
     */
    public function testLoad(): void
    {
        $loader = new ValidatorConfigLoader();

        $this->assertSame([
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
                    NumericConstraint::class => NumericConstraint::class,
                    StringConstraint::class => StringConstraint::class,
                ],
            ],
        ], $loader->load());
    }
}
