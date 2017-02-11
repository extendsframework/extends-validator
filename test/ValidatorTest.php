<?php

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

class ValidatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Validator::add()
     * @covers \ExtendsFramework\Validator\Validator::validate()
     * @covers \ExtendsFramework\Validator\Validator::violations()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::__construct()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::constraint()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::interrupt()
     */
    public function testCanAttachConstraintValidateInterruptAndGetViolations()
    {
        $constraint1 = $this->createMock(ConstraintInterface::class);
        $constraint1
            ->expects($this->once())
            ->method('assert')
            ->with('foo', ['bar' => 'baz'])
            ->willReturn(true);

        $violation = new ConstraintViolation('', []);
        $constraint2 = $this->createMock(ConstraintInterface::class);
        $constraint2
            ->expects($this->once())
            ->method('assert')
            ->with('foo', ['bar' => 'baz'])
            ->willThrowException($violation);

        $constraint3 = $this->createMock(ConstraintInterface::class);
        $constraint3
            ->expects($this->never())
            ->method('assert');

        /**
         * @var ConstraintInterface $constraint1
         * @var ConstraintInterface $constraint2
         * @var ConstraintInterface $constraint3
         */
        $validator = new Validator();
        $valid = $validator
            ->add($constraint1)
            ->add($constraint2, true)
            ->add($constraint3)
            ->validate('foo', ['bar' => 'baz']);
        $violations = $validator->violations();

        $this->assertFalse($valid);
        $this->assertSame([$violation], $violations);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Validator::violations()
     * @covers                   \ExtendsFramework\Validator\Exception\ValidatorNotValidated::forViolations()
     * @expectedException        \ExtendsFramework\Validator\Exception\ValidatorNotValidated
     * @expectedExceptionMessage Validator MUST be validated to get violations, call validate() first.
     */
    public function testCanNotGetViolationsWhenNotValidated()
    {
        $validator = new Validator();
        $validator->violations();
    }
}
