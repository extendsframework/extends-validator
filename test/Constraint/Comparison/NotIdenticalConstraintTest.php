<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class NotIdenticalConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is not identical to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\NotIdenticalConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new NotIdenticalConstraint();

        $this->assertNull($constraint->validate('1', 1));
    }

    /**
     * Invalid.
     *
     * Test that string '1' is identical to string '1'.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\NotIdenticalConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\NotIdenticalConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new NotIdenticalConstraint();
        $result = $constraint->validate('1', '1');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value is identical to context.', $result->getMessage());
            $this->assertSame([], $result->getParameters());
        }
    }
}
