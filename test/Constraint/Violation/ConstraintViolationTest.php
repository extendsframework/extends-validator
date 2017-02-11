<?php

namespace ExtendsFramework\Validator\Constraint\Exception;

class ConstraintViolationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::getParameters()
     * @covers \ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation::__toString()
     */
    public function testCanCreateStringRepresentation()
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
}
