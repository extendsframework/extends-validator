<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use PHPUnit\Framework\TestCase;

class LessOrEqualValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that int '1' is less than int '2' and int '1' is equal to int '1'.
     *
     * @covers \ExtendsFramework\Validator\Comparison\LessOrEqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\AbstractComparisonValidator::getSubject()
     */
    public function testValid(): void
    {
        $validator = new LessOrEqualValidator(2);
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
     * @covers \ExtendsFramework\Validator\Comparison\LessOrEqualValidator::validate()
     * @covers \ExtendsFramework\Validator\Comparison\AbstractComparisonValidator::getSubject()
     * @covers \ExtendsFramework\Validator\Comparison\LessOrEqualValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new LessOrEqualValidator(1);
        $result = $validator->validate(2);

        $this->assertFalse($result->isValid());
    }
}
