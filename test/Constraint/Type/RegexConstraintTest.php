<?php

namespace ExtendsFramework\Validator\Constraint\Type;

class RegexConstraintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::validate()
     */
    public function testCanAssertValidValue()
    {
        $constraint = new RegexConstraint('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $assert = $constraint->assert('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');

        $this->assertTrue($assert);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::__construct()
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::violate()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::__construct()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::assert()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value {{value}} must match regular expression {{pattern}}.
     */
    public function testCanNotAssertInvalidValid()
    {
        $constraint = new RegexConstraint('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $constraint->assert('foo-bar-baz');
        $valid = $constraint->validate('foo-bar-baz');

        $this->assertFalse($valid);
    }
}
