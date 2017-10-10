<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

use PHPUnit\Framework\TestCase;

class ConstraintViolationTest extends TestCase
{
    /**
     * Get parameters.
     *
     * Test if all the get parameters return the given construct values.
     *
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::getMessage()
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::getParameters()
     */
    public function testGetParameters(): void
    {
        $violation = new ConstraintViolation('Value "{{foo}}" is equal to "{{bar}}".', [
            'foo' => 'baz',
            'bar' => 'baz',
        ]);

        $this->assertEquals('Value "{{foo}}" is equal to "{{bar}}".', $violation->getMessage());
        $this->assertEquals([
            'foo' => 'baz',
            'bar' => 'baz',
        ], $violation->getParameters());
    }

    /**
     * Json serializable.
     *
     * Test that object JSON serialization will return correct string.
     *
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::jsonSerialize()
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::getMessage()
     * @covers \ExtendsFramework\Validator\Constraint\ConstraintViolation::getParameters()
     */
    public function testJsonSerializable(): void
    {
        $violation = new ConstraintViolation('Value "{{foo}}" is equal to "{{bar}}".', [
            'foo' => 'baz',
            'bar' => 'baz',
        ]);

        $this->assertSame('"Value \"baz\" is equal to \"baz\"."', json_encode($violation));
    }
}
