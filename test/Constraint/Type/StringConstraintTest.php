<?php

namespace ExtendsFramework\Validator\Constraint\Type;

class StringConstraintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::validate()
     */
    public function testCanAssertValidValue()
    {
        $constraint = new StringConstraint();
        $assert = $constraint->assert('foo');

        $this->assertTrue($assert);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\StringConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\StringConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value must be a string, got "{{type}}".
     */
    public function testCanNotAssertInvalidValid()
    {
        $constraint = new StringConstraint();
        $constraint->assert(9);
    }
}
