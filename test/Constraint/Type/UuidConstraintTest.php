<?php

namespace ExtendsFramework\Validator\Constraint\Type;

class UuidConstraintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::validate()
     */
    public function testCanAssertValidUuid()
    {
        $constraint = new UuidConstraint();
        $assert = $constraint->assert('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');

        $this->assertTrue($assert);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value {{value}} must be a valid UUID.
     */
    public function testCanNotAssertInvalidUuid()
    {
        $constraint = new UuidConstraint();
        $constraint->assert('foo-bar-baz');
    }
}
