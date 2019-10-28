<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Exception\TemplateNotFound;
use PHPUnit\Framework\TestCase;

class AbstractValidatorTest extends TestCase
{
    /**
     * Valid result.
     *
     * Test that a valid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\AbstractValidator::validate()
     * @covers \ExtendsFramework\Validator\AbstractValidator::getValidResult()
     */
    public function testValidResult(): void
    {
        $validator = new ValidatorStub();
        $result = $validator->validate('foo', true);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid result.
     *
     * Test that a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\AbstractValidator::validate()
     * @covers \ExtendsFramework\Validator\AbstractValidator::getInvalidResult()
     */
    public function testInvalidResult(): void
    {
        $validator = new ValidatorStub();
        $result = $validator->validate('foo', false);

        $this->assertFalse($result->isValid());
    }

    /**
     * Template not found.
     *
     * Test that exception TemplateNotFound will be thrown when template for key 'foo' can not be found.
     *
     * @covers \ExtendsFramework\Validator\AbstractValidator::validate()
     * @covers \ExtendsFramework\Validator\AbstractValidator::getInvalidResult()
     * @covers \ExtendsFramework\Validator\Exception\TemplateNotFound::__construct()
     */
    public function testTemplateNotFound(): void
    {
        $this->expectException(TemplateNotFound::class);
        $this->expectExceptionMessage('No invalid result template found for key "foo".');

        $validator = new ValidatorStub();

        $validator->validate('foo');
    }
}
