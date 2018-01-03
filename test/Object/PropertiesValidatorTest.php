<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Object;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class PropertiesValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that object is valid.
     *
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::__construct()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::addProperty()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::validate()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getProperties()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::isStrict()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::checkStrictness()
     */
    public function testIsValid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->method('isValid')
            ->willReturn(true);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->exactly(3))
            ->method('validate')
            ->withConsecutive(
                ['bar', 'context'],
                ['baz', 'context'],
                ['qux', 'context']
            )
            ->willReturn($result);

        $properties = new PropertiesValidator([
            'foo' => $validator,
            'bar' => $validator,
            'baz' => $validator,
            'qux' => [$validator, true],
        ]);
        $result = $properties->validate((object)[
            'foo' => 'bar',
            'bar' => 'baz',
            'baz' => 'qux',
        ], 'context');

        $this->assertTrue($result->isValid());
    }

    /**
     * Strict.
     *
     * Test that undefined object property is not allowed.
     *
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::__construct()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::addProperty()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::validate()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getProperties()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::isStrict()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::checkStrictness()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getTemplates()
     */
    public function testStrict(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->method('isValid')
            ->willReturn(true);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->once())
            ->method('validate')
            ->with('bar', 'context')
            ->willReturn($result);

        $properties = new PropertiesValidator([
            'foo' => $validator,
        ]);
        $result = $properties->validate((object)[
            'foo' => 'bar',
            'bar' => 'baz',
        ], 'context');

        $this->assertFalse($result->isValid());
    }

    /**
     * Not strict.
     *
     * Test that undefined object properties are allowed.
     *
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::__construct()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::validate()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getProperties()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::isStrict()
     */
    public function testNotStrict()
    {
        $properties = new PropertiesValidator(null, false);
        $result = $properties->validate((object)[
            'foo' => 'bar',
            'bar' => 'baz',
        ], 'context');

        $this->assertTrue($result->isValid());
    }

    /**
     * Property missing.
     *
     * Test that missing property will give invalid result.
     *
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::__construct()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::addProperty()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::validate()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getProperties()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::isStrict()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getTemplates()
     */
    public function testPropertyMissing(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->never())
            ->method('validate');

        $properties = new PropertiesValidator([
            'foo' => $validator,
        ]);
        $result = $properties->validate((object)[], 'context');

        $this->assertFalse($result->isValid());
    }

    /**
     * Not object.
     *
     * Test that a non object can not be validated.
     *
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::__construct()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::validate()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getProperties()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::isStrict()
     * @covers \ExtendsFramework\Validator\Object\PropertiesValidator::getTemplates()
     */
    public function testNotObject(): void
    {
        $properties = new PropertiesValidator();
        $result = $properties->validate([]);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory will return correct instance.
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->expects($this->once())
            ->method('getService')
            ->with(ValidatorInterface::class, ['foo' => 'bar'])
            ->willReturn($this->createMock(ValidatorInterface::class));

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $properties = PropertiesValidator::factory(PropertiesValidator::class, $serviceLocator, [
            'properties' => [
                [
                    'property' => 'foo',
                    'validator' => [
                        'name' => ValidatorInterface::class,
                        'options' => [
                            'foo' => 'bar',
                        ],
                    ],
                    'optional' => false,
                ],
            ],
            'strict' => false,
        ]);

        $this->assertInstanceOf(PropertiesValidator::class, $properties);
    }
}
