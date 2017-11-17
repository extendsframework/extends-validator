<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class NumericConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that integer value '9' is an valid integer and null will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new NumericConstraint();

        $this->assertNull($constraint->validate(9));
        $this->assertNull($constraint->validate('9'));
        $this->assertNull($constraint->validate(9.9));
        $this->assertNull($constraint->validate('9.9'));
    }

    /**
     * Invalid.
     *
     * Test that string value 'foo' is an valid integer and ConstraintViolationInterface instance will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\IntegerConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testInvalid(): void
    {
        $constraint = new NumericConstraint();
        $result = $constraint->validate('foo');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value must be a number, got "{{type}}".', $result->getMessage());
            $this->assertSame([
                'type' => 'string',
            ], $result->getParameters());
        }
    }
}
