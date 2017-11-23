<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Loader;

use ExtendsFramework\ServiceLocator\Resolver\Factory\FactoryResolver;
use ExtendsFramework\ServiceLocator\Resolver\StaticFactory\StaticFactoryResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Comparison\EqualValidator;
use ExtendsFramework\Validator\Comparison\GreaterOrEqualValidator;
use ExtendsFramework\Validator\Comparison\GreaterThanValidator;
use ExtendsFramework\Validator\Comparison\IdenticalValidator;
use ExtendsFramework\Validator\Comparison\LessOrEqualValidator;
use ExtendsFramework\Validator\Comparison\LessThanValidator;
use ExtendsFramework\Validator\Comparison\NotEqualValidator;
use ExtendsFramework\Validator\Comparison\NotIdenticalValidator;
use ExtendsFramework\Validator\Format\RegexValidator;
use ExtendsFramework\Validator\Format\UuidValidator;
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
        ], $loader->load());
    }
}
