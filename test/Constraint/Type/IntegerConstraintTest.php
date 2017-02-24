<?php

namespace ExtendsFramework\Validator\Constraint\Type;

class IntegerConstraintTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::validate()
     */
    public function testCanAssertValidValue()
    {
        $constraint = new IntegerConstraint();
        $assert = $constraint->assert(9);

        $this->assertTrue($assert);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value must be a integer, got "{{type}}".
     */
    public function testCanNotAssertInvalidValid()
    {
        $constraint = new IntegerConstraint();
        $constraint->assert('foo');
    }
}
