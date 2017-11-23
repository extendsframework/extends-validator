<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class LessThanValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '1' is less than int '2'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\LessThanValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new LessThanValidator();
        $result = $validator->validate(1, 2);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int '2' is not less than int '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\LessThanValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\LessThanValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new LessThanValidator();
        $result = $validator->validate(2, 1);

        $this->assertFalse($result->isValid());
    }
}
