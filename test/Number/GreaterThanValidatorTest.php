<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class GreaterThanValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '2' is greater than int '1'.
     *
     * @covers \ExtendsFramework\Validator\Number\GreaterThanValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new GreaterThanValidator(1);
        $result = $validator->validate(2);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than int '2'.
     *
     * @covers \ExtendsFramework\Validator\Number\GreaterThanValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\GreaterThanValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new GreaterThanValidator(1);
        $result = $validator->validate(1);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\GreaterThanValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new GreaterThanValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
