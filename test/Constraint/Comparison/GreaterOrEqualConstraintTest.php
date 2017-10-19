<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class GreaterOrEqualConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '2' is greater than int '1' and int '2' is equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::factory()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\GreaterOrEqualConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = GreaterOrEqualConstraint::factory([]);

        $this->assertNull($constraint->validate(2, 1));
        $this->assertNull($constraint->validate(2, 2));
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than or equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\GreaterOrEqualConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\GreaterOrEqualConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new GreaterOrEqualConstraint();
        $result = $constraint->validate(1, 2);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not greater than or equal to context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
