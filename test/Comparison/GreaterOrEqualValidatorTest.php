<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class GreaterOrEqualValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '2' is greater than int '1' and int '2' is equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\GreaterOrEqualValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new GreaterOrEqualValidator();
        $result1 = $validator->validate(2, 1);
        $result2 = $validator->validate(2, 2);

        $this->assertTrue($result1->isValid());
        $this->assertTrue($result2->isValid());
    }

    /**
     * Invalid.
     *
     * Test that int '1' is not greater than or equal to int '2'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\GreaterOrEqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\GreaterOrEqualValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new GreaterOrEqualValidator();
        $result = $validator->validate(1, 2);

        $this->assertFalse($result->isValid());
    }
}
