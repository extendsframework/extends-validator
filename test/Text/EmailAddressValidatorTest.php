<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class EmailAddressValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that an valid email address will validate.
     *
     * @covers \ExtendsFramework\Validator\Text\EmailAddressValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new EmailAddressValidator();
        $result = $validator->validate('vincent@extends.nl');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that an invalid email address value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Text\EmailAddressValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\EmailAddressValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new EmailAddressValidator();
        $result = $validator->validate('foo-bar-baz');

        $this->assertFalse($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that none string value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Text\EmailAddressValidator::validate()
     */
    public function testNotString(): void
    {
        $validator = new EmailAddressValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Text\EmailAddressValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = EmailAddressValidator::factory(EmailAddressValidator::class, $serviceLocator);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
