<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Exception;

use PHPUnit\Framework\TestCase;

class ConstraintViolationTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::getParameters()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::__toString()
     */
    public function testCanCreateStringRepresentation(): void
    {
        $violation = new ConstraintViolation('Value {{foo}} is equal to {{bar}}.', [
            'foo' => 'baz',
            'bar' => 'baz',
        ]);
        $message = (string)$violation;
        $parameters = $violation->getParameters();

        $this->assertEquals('Value baz is equal to baz.', $message);
        $this->assertEquals([
            'foo' => 'baz',
            'bar' => 'baz',
        ], $parameters);
    }

    /**
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::jsonSerialize()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::__toString()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::getParameters()
     */
    public function testCanJsonSerialize(): void
    {
        $violation = new ConstraintViolation('Value {{foo}} is equal to {{bar}}.', [
            'foo' => 'baz',
            'bar' => 'baz',
        ]);

        $this->assertSame('"Value baz is equal to baz."', json_encode($violation));
    }
}
