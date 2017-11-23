<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class GreaterThanValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '2' is greater than int '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\GreaterThanValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new GreaterThanValidator();
        $result = $validator->validate(2, 1);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than int '2'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\GreaterThanValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\GreaterThanValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new GreaterThanValidator();
        $result = $validator->validate(1, 2);

        $this->assertFalse($result->isValid());
    }
}
