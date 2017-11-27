<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class LessThanValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '1' is less than int '2'.
     *
     * @covers \ExtendsFramework\Validator\Number\LessThanValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new LessThanValidator(2);
        $result = $validator->validate(1);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int '2' is not less than int '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\LessThanValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\LessThanValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new LessThanValidator(1);
        $result = $validator->validate(2);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\LessThanValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new LessThanValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
