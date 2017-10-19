<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class BooleanConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that boolean value 'true' is a boolean.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\AbstractTypeConstraint::factory()
     * @covers \ExtendsFramework\Validator\Constraint\Type\BooleanConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = BooleanConstraint::factory([]);
        $result = $constraint->validate(true);

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that int value '1' is not a boolean.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\BooleanConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\BooleanConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testInvalid(): void
    {
        $constraint = new BooleanConstraint();
        $result = $constraint->validate(1);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value must be a boolean, got "{{type}}".', $result->getMessage());
            $this->assertSame([
                'type' => 'integer',
            ], $result->getParameters());
        }
    }
}
