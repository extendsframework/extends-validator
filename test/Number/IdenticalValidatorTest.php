<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class IdenticalValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is identical to string '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\IdenticalValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new IdenticalValidator(1);
        $result = $validator->validate(1.0);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is not identical to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\IdenticalValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\IdenticalValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new IdenticalValidator(1);
        $result = $validator->validate(1);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\IdenticalValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new IdenticalValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
