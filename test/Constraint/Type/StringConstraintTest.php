<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class StringConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string value 'foo' is a valid string and null will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::validate()
     */
    public function testCanAssertValidValue(): void
    {
        $constraint = new StringConstraint();
        $result = $constraint->validate('foo');

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that integer value '9' is a valid string and ConstraintViolationInterface instance will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\StringConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testCanNotAssertInvalidValid(): void
    {
        $constraint = new StringConstraint();
        $result = $constraint->validate(9);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value must be a string, got "{{type}}".', $result->getMessage());
            $this->assertSame([
                'type' => 'integer',
            ], $result->getParameters());
        }
    }
}
