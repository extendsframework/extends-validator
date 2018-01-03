<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class UuidValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that value 'db6eb6f2-1dda-4f06-a995-1fd1aca99e1f' is an valid UUID.
     *
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::getPattern()
     */
    public function testValid(): void
    {
        $validator = new UuidValidator();

        $this->assertTrue($validator->validate('db6eb6f2-1dda-1f06-a995-1fd1aca99e1f')->isValid()); // Version 1
        $this->assertTrue($validator->validate('db6eb6f2-1dda-2f06-a995-1fd1aca99e1f')->isValid()); // Version 2
        $this->assertTrue($validator->validate('db6eb6f2-1dda-3f06-a995-1fd1aca99e1f')->isValid()); // Version 3
        $this->assertTrue($validator->validate('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f')->isValid()); // Version 4
        $this->assertTrue($validator->validate('db6eb6f2-1dda-5f06-a995-1fd1aca99e1f')->isValid()); // Version 5
    }

    /**
     * Invalid.
     *
     * Test that string value ''foo-bar-baz'' is a valid string.
     *
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::getPattern()
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new UuidValidator();

        $this->assertFalse($validator->validate('foo-bar-baz')->isValid());
        $this->assertFalse($validator->validate('db6eb6f2-1dda-6f06-a995-1fd1aca99e1f')->isValid()); // Version unknown
    }

    /**
     * Invalid.
     *
     * Test that none string value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::validate()
     */
    public function testNotString(): void
    {
        $validator = new UuidValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Text\UuidValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = UuidValidator::factory(UuidValidator::class, $serviceLocator);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
