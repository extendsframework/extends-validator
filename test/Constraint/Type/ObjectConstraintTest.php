<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

class ObjectConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that stdClass is an valid object and null will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\ObjectConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new ObjectConstraint();
        $result = $constraint->validate(new stdClass());

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that string value 'foo' is not an object and ConstraintViolationInterface instance will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\ObjectConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Type\ObjectConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testInvalid(): void
    {
        $constraint = new ObjectConstraint();
        $result = $constraint->validate('foo');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value must be an object, got "{{type}}".', $result->getMessage());
            $this->assertSame([
                'type' => 'string',
            ], $result->getParameters());
        }
    }
}
