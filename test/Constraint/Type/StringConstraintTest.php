<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use PHPUnit\Framework\TestCase;

class StringConstraintTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::validate()
     */
    public function testCanAssertValidValue(): void
    {
        $constraint = new StringConstraint();
        $constraint->assert('foo');
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\StringConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\StringConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value must be a string, got "{{type}}".
     */
    public function testCanNotAssertInvalidValid(): void
    {
        $constraint = new StringConstraint();
        $constraint->assert(9);
    }
}
