<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class LessThanConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '1' is less than int '2'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\LessThanConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::factory()
     */
    public function testValid(): void
    {
        $constraint = LessThanConstraint::factory([]);

        $this->assertNull($constraint->validate(1, 2));
    }

    /**
     * Invalid.
     *
     * Test that int '2' is not less than int '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\LessThanConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\LessThanConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new LessThanConstraint();
        $result = $constraint->validate(2, 1);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not less than context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
