<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class GreaterThanConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '2' is greater than int '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::factory()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\GreaterThanConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = GreaterThanConstraint::factory([]);

        $this->assertNull($constraint->validate(2, 1));
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than int '2'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\GreaterThanConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\GreaterThanConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new GreaterThanConstraint();
        $result = $constraint->validate(1, 2);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not greater than context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
