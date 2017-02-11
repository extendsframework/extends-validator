<?php

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;

class AbstractConstraintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     */
    public function testCanValidateAssert()
    {
        $constraint = $this->getMockForAbstractClass(AbstractConstraint::class);
        $constraint
            ->expects($this->once())
            ->method('assert')
            ->with('foo', []);

        /**
         * @var AbstractConstraint $constraint
         */
        $valid = $constraint->validate('foo', []);

        $this->assertTrue($valid);
    }

    /**
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     */
    public function testCanCatchViolationException()
    {
        $constraint = $this->getMockForAbstractClass(AbstractConstraint::class);
        $constraint
            ->expects($this->once())
            ->method('assert')
            ->with('foo', [])
            ->willThrowException(new ConstraintViolation('Value must be valid.', []));

        /**
         * @var AbstractConstraint $constraint
         */
        $valid = $constraint->validate('foo', []);

        $this->assertFalse($valid);
    }
}
