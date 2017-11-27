<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class NotEqualValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is not equal to string '2'.
     *
     * @covers \ExtendsFramework\Validator\Number\NotEqualValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new NotEqualValidator(1);
        $result = $validator->validate('2');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is equal to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\NotEqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\NotEqualValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new NotEqualValidator(1);
        $result = $validator->validate('1');

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\NotEqualValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new NotEqualValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
