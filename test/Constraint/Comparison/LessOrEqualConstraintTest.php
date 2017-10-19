<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class LessOrEqualConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '1' is less than int '2' and int '1' is equal to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\LessOrEqualConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::factory()
     */
    public function testValid(): void
    {
        $constraint = LessOrEqualConstraint::factory([]);

        $this->assertNull($constraint->validate(1, 2));
        $this->assertNull($constraint->validate(1, 1));
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than or equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\LessOrEqualConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\LessOrEqualConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new LessOrEqualConstraint();
        $result = $constraint->validate(2, 1);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not less than or equal to context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
