<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class NotIdenticalValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is not identical to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\NotIdenticalValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new NotIdenticalValidator(1);
        $result = $validator->validate(1.0);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is identical to string '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\NotIdenticalValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\NotIdenticalValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new NotIdenticalValidator(1);
        $result = $validator->validate(1);

        $this->assertFalse($result->isValid());
    }
}
