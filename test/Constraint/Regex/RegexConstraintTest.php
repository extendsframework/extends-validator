<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Regex;

use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class RegexConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that valid uuid value will validate against regular expression and return null.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Regex\RegexConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Regex\RegexConstraint::validate()
     */
    public function testValid(): void
    {
        $constraint = new RegexConstraint('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $result = $constraint->validate('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that invalid uuid value will not validate against regular expression and return
     * ConstraintViolationInterface.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Regex\RegexConstraint::__construct()
     * @covers \ExtendsFramework\Validator\Constraint\Regex\RegexConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Regex\RegexConstraint::getTemplates()
     */
    public function testInvalid(): void
    {
        $constraint = new RegexConstraint('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $result = $constraint->validate('foo-bar-baz');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Value "{{value}}" must match regular expression "{{pattern}}".', $result->getMessage());
            $this->assertSame([
                'value' => 'foo-bar-baz',
                'pattern' => '/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i',
            ], $result->getParameters());
        }
    }
}
