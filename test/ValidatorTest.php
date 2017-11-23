<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolation;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    /**
     * Validate.
     *
     * Test that validator can validate constraints, break on failure and return invalid result with violation.
     *
     * @covers \ExtendsFramework\Validator\Validator::addConstraint()
     * @covers \ExtendsFramework\Validator\Validator::validate()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::__construct()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::getConstraint()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::mustInterrupt()
     * @covers \ExtendsFramework\Validator\ValidatorResult::__construct()
     * @covers \ExtendsFramework\Validator\ValidatorResult::isValid()
     * @covers \ExtendsFramework\Validator\ValidatorResult::getViolations()
     */
    public function testValidate(): void
    {
        $constraint1 = $this->createMock(ConstraintInterface::class);
        $constraint1
            ->expects($this->once())
            ->method('validate')
            ->with('foo', ['bar' => 'baz'])
            ->willReturn(null);

        $violation = new ConstraintViolation('', []);
        $constraint2 = $this->createMock(ConstraintInterface::class);
        $constraint2
            ->expects($this->once())
            ->method('validate')
            ->with('foo', ['bar' => 'baz'])
            ->willReturn($violation);

        $constraint3 = $this->createMock(ConstraintInterface::class);
        $constraint3
            ->expects($this->never())
            ->method('validate');

        /**
         * @var ConstraintInterface $constraint1
         * @var ConstraintInterface $constraint2
         * @var ConstraintInterface $constraint3
         */
        $validator = new Validator();
        $result = $validator
            ->addConstraint($constraint1)
            ->addConstraint($constraint2, true)
            ->addConstraint($constraint3)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertInstanceOf(ValidatorResultInterface::class, $result);
        $this->assertFalse($result->isValid());
        $this->assertSame([
            $violation,
        ], $result->getViolations());
    }
}
