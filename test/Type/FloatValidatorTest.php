<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use PHPUnit\Framework\TestCase;

class FloatValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that float value '9.0' is a float.
     *
     * @covers \ExtendsFramework\Validator\Type\FloatValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new FloatValidator();
        $result = $validator->validate(9.1);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int value '9' is not a float.
     *
     * @covers \ExtendsFramework\Validator\Type\FloatValidator::validate()
     * @covers \ExtendsFramework\Validator\Type\FloatValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new FloatValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }
}
