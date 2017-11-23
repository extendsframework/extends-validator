<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use PHPUnit\Framework\TestCase;

class NumericValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that integer value '9' is an valid integer.
     *
     * @covers \ExtendsFramework\Validator\Type\NumericValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new NumericValidator();
        $result = $validator->validate('9.9');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string value 'foo' is an valid integer.
     *
     * @covers \ExtendsFramework\Validator\Type\NumericValidator::validate()
     * @covers \ExtendsFramework\Validator\Type\NumericValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new NumericValidator();
        $result = $validator->validate('foo');

        $this->assertFalse($result->isValid());
    }
}
