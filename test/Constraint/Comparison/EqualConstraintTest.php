<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class EqualConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is equal to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\EqualConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new EqualConstraint();

        $this->assertNull($constraint->validate('1', 1));
    }

    /**
     * Invalid.
     *
     * Test that string '1' is not equal to string '2'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\EqualConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\EqualConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new EqualConstraint();
        $result = $constraint->validate('1', '2');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is not equal to context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
