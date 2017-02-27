<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use PHPUnit\Framework\TestCase;

class RegexConstraintTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::validate()
     */
    public function testCanAssertValidValue(): void
    {
        $constraint = new RegexConstraint('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $constraint->assert('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::__construct()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\RegexConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value {{value}} must match regular expression {{pattern}}.
     */
    public function testCanNotAssertInvalidValid(): void
    {
        $constraint = new RegexConstraint('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $constraint->assert('foo-bar-baz');
        $valid = $constraint->validate('foo-bar-baz');

        $this->assertFalse($valid);
    }
}
