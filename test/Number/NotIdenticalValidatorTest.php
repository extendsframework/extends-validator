<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class NotIdenticalValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is not identical to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\NotIdenticalValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new NotIdenticalValidator(1);
        $result = $validator->validate(1);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is identical to string '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\NotIdenticalValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\NotIdenticalValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new NotIdenticalValidator(1);
        $result = $validator->validate(1.0);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\NotIdenticalValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new NotIdenticalValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
