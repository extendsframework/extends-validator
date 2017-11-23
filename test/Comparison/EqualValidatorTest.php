<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class EqualValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is equal to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\EqualValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new EqualValidator();
        $result = $validator->validate('1', 1);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is not equal to string '2'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\EqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\EqualValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new EqualValidator();
        $result = $validator->validate('1', '2');

        $this->assertFalse($result->isValid());
    }
}
