<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class IdenticalConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is identical to string '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\IdenticalConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::factory()
     */
    public function testValid(): void
    {
        $constraint = IdenticalConstraint::factory([]);

        $this->assertNull($constraint->validate('1', '1'));
    }

    /**
     * Invalid.
     *
     * Test that string '1' is not identical to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\IdenticalConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\IdenticalConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new IdenticalConstraint();
        $result = $constraint->validate('1', 1);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not identical to context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
