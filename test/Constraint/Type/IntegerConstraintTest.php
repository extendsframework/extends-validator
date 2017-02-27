<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use PHPUnit\Framework\TestCase;

class IntegerConstraintTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::validate()
     */
    public function testCanAssertValidValue(): void
    {
        $constraint = new IntegerConstraint();
        $constraint->assert(9);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value must be a integer, got "{{type}}".
     */
    public function testCanNotAssertInvalidValid(): void
    {
        $constraint = new IntegerConstraint();
        $constraint->assert('foo');
    }
}
