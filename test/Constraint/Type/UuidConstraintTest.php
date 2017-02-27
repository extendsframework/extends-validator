<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use PHPUnit\Framework\TestCase;

class UuidConstraintTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::assert()
     * @covers \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::validate()
     */
    public function testCanAssertValidUuid(): void
    {
        $constraint = new UuidConstraint();
        $constraint->assert('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::assert()
     * @covers                   \ExtendsFramework\Validator\Constraint\Type\UuidConstraint::getTemplates()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation
     * @expectedExceptionMessage Value {{value}} must be a valid UUID.
     */
    public function testCanNotAssertInvalidUuid(): void
    {
        $constraint = new UuidConstraint();
        $constraint->assert('foo-bar-baz');
    }
}
