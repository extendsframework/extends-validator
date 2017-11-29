<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class NotEmptyValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that value is not a empty string.
     *
     * @covers \ExtendsFramework\Validator\Text\NotEmptyValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new NotEmptyValidator();

        $this->assertTrue($validator->validate('foo')->isValid());
    }

    /**
     * Invalid.
     *
     * Test that value is a empty string.
     *
     * @covers \ExtendsFramework\Validator\Text\NotEmptyValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\NotEmptyValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new NotEmptyValidator();

        $this->assertFalse($validator->validate('')->isValid());
    }

    /**
     * Invalid.
     *
     * Test that none string value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Text\NotEmptyValidator::validate()
     */
    public function testNotString(): void
    {
        $validator = new NotEmptyValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Text\NotEmptyValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = NotEmptyValidator::factory(NotEmptyValidator::class, $serviceLocator);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
