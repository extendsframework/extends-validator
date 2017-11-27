<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class EqualValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that string '1' is equal to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\EqualValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new EqualValidator(1);
        $result = $validator->validate('1');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that string '1' is not equal to string '2'.
     *
     * @covers \ExtendsFramework\Validator\Number\EqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\EqualValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new EqualValidator(2);
        $result = $validator->validate('1');

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\EqualValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new EqualValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
