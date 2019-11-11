<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use PHPUnit\Framework\TestCase;

class NullValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that null value is valid.
     *
     * @covers \ExtendsFramework\Validator\Type\NullValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new NullValidator();
        $result = $validator->validate(null);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that a non-null value is invalid.
     *
     * @covers \ExtendsFramework\Validator\Type\NullValidator::validate()
     * @covers \ExtendsFramework\Validator\Type\NullValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new NullValidator();
        $result = $validator->validate('foo');

        $this->assertFalse($result->isValid());
    }
}
