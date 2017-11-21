<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class ArrayConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that boolean value '[]' is an array.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\ArrayConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new ArrayConstraint();
        $result = $constraint->validate([]);

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that int value '1' is not an array.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\ArrayConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\ArrayConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testInvalid(): void
    {
        $constraint = new ArrayConstraint();
        $result = $constraint->validate(1);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value must be an array, got "{{type}}".', $result->getMessage());
            $this->assertSame([
                'type' => 'integer',
            ], $result->getParameters());
        }
    }
}
