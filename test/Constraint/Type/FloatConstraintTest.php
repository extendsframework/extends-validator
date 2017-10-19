<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class FloatConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that float value '9.0' is a float.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\AbstractTypeConstraint::factory()
     * @covers \ExtendsFramework\Validator\Constraint\Type\FloatConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = FloatConstraint::factory([]);
        $result = $constraint->validate(9.1);

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that int value '9' is not a float.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\FloatConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\FloatConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testInvalid(): void
    {
        $constraint = new FloatConstraint();
        $result = $constraint->validate(9);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value must be a float, got "{{type}}".', $result->getMessage());
            $this->assertSame([
                'type' => 'integer',
            ], $result->getParameters());
        }
    }
}
