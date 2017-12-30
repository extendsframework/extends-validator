<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Result\ResultInterface;
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
     * @covers                   \ExtendsFramework\Validator\AbstractValidator::validate()
     * @covers                   \ExtendsFramework\Validator\AbstractValidator::getInvalidResult()
     * @covers                   \ExtendsFramework\Validator\Exception\TemplateNotFound::__construct()
     * @expectedException        \ExtendsFramework\Validator\Exception\TemplateNotFound
     * @expectedExceptionMessage No invalid result template found for key "foo".
     */
    public function testTemplateNotFound(): void
    {
        $validator = new ValidatorStub();

        $validator->validate('foo');
    }
}

class ValidatorStub extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($context === true) {
            return $this->getValidResult();
        }
        if ($context === false) {
            return $this->getInvalidResult('bar', []);
        }

        return $this->getInvalidResult('foo', []);
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            'bar' => 'Fancy error message.',
        ];
    }
}
