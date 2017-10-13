<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class NotConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '0' is false.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\NotConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new NotConstraint();

        $this->assertNull($constraint->validate(0));
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not false.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\NotConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\NotConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new NotConstraint();
        $result = $constraint->validate(1);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not equal to false.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
