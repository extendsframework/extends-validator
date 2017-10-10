<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Uuid;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class UuidConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that value 'db6eb6f2-1dda-4f06-a995-1fd1aca99e1f' is an valid UUID and null will bet returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Uuid\UuidConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new UuidConstraint();
        $result = $constraint->validate('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that string value ''foo-bar-baz'' is a valid string and ConstraintViolationInterface instance will be
     * returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Uuid\UuidConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Uuid\UuidConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testCanNotAssertInvalidUuid(): void
    {
        $constraint = new UuidConstraint();
        $result = $constraint->validate('foo-bar-baz');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value "{{value}}" must be a valid UUID.', $result->getMessage());
            $this->assertSame([
                'value' => 'foo-bar-baz',
            ], $result->getParameters());
        }
    }
}