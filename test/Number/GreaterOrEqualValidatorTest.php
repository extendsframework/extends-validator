<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use PHPUnit\Framework\TestCase;

class GreaterOrEqualValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '2' is greater than int '1' and int '2' is equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Number\GreaterOrEqualValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new GreaterOrEqualValidator(1);
        $result1 = $validator->validate(1);
        $result2 = $validator->validate(2);

        $this->assertTrue($result1->isValid());
        $this->assertTrue($result2->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than or equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Number\GreaterOrEqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Number\GreaterOrEqualValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new GreaterOrEqualValidator(2);
        $result = $validator->validate(1);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not numeric.
     *
     * Test that value is not numeric and validate will not validate.
     *
     * @covers \ExtendsFramework\Validator\Number\GreaterOrEqualValidator::validate()
     */
    public function testNotNumeric(): void
    {
        $validator = new GreaterOrEqualValidator(2);
        $result = $validator->validate('a');

        $this->assertFalse($result->isValid());
    }
}
