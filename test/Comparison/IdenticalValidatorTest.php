<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class IdenticalValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is identical to string '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\IdenticalValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new IdenticalValidator();
        $result = $validator->validate('1', '1');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is not identical to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\IdenticalValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\IdenticalValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new IdenticalValidator();
        $result = $validator->validate('1', 1);

        $this->assertFalse($result->isValid());
    }
}
