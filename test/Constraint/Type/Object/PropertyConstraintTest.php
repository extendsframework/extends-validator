<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type\Object;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class PropertyConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that existing and valid property will not return a violation.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = $this->createMock(ConstraintInterface::class);
        $constraint
            ->expects($this->once())
            ->method('validate')
            ->with('bar')
            ->willReturn(null);

        /**
         * @var ConstraintInterface $constraint
         */
        $property = new PropertyConstraint('foo', $constraint);
        $violation = $property->validate((object)[
            'foo' => 'bar',
        ]);

        $this->assertNull($violation);
    }

    /**
     * Optional.
     *
     * Test that a option missing property will not return a violation.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::validate()
     */
    public function testOptional(): void
    {
        $constraint = $this->createMock(ConstraintInterface::class);
        $constraint
            ->expects($this->never())
            ->method('validate');

        /**
         * @var ConstraintInterface $constraint
         */
        $property = new PropertyConstraint('foo', $constraint, true);
        $violation = $property->validate((object)[]);

        $this->assertNull($violation);
    }

    /**
     * Not optional.
     *
     * Test that a not optional and missing property will return a violation.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::getTemplates()
     */
    public function testNotOptional(): void
    {
        $constraint = $this->createMock(ConstraintInterface::class);
        $constraint
            ->expects($this->never())
            ->method('validate');

        /**
         * @var ConstraintInterface $constraint
         */
        $property = new PropertyConstraint('foo', $constraint);
        $violation = $property->validate((object)[]);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $violation);
        if ($violation instanceof ConstraintViolationInterface) {
            $this->assertSame('Property "{{property}}" must exists and can not be left empty.', $violation->getMessage());
            $this->assertSame([
                'property' => 'foo',
            ], $violation->getParameters());
        }
    }

    /**
     * Factory.
     *
     * Test that factory will return instance of PropertyConstraint.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::factory()
     * @covers \ExtendsFramework\Validator\Constraint\Type\Object\PropertyConstraint::__construct()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->expects($this->once())
            ->method('getService')
            ->with(ConstraintInterface::class, [
                'foo' => 'bar',
            ])
            ->willReturn($this->createMock(ConstraintInterface::class));

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $property = PropertyConstraint::factory('', $serviceLocator, [
            'property' => 'foo',
            'constraint' => [
                'name' => ConstraintInterface::class,
                'options' => [
                    'foo' => 'bar',
                ],
            ],
            'optional' => true,
        ]);

        $this->assertInstanceOf(PropertyConstraint::class, $property);
    }
}
