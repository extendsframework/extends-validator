<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class LengthValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that text length is in expected range and a valid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::__construct()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getMin()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getMax()
     */
    public function testValid(): void
    {
        $validator = new LengthValidator(5, 15);
        $result = $validator->validate('foo bar baz');

        $this->assertTrue($result->isValid());
    }

    /**
     * Too short.
     *
     * Test that string is too short and a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::__construct()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getMin()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getMax()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getTemplates()
     */
    public function testTooShort(): void
    {
        $validator = new LengthValidator(5);
        $result = $validator->validate('foo');

        $this->assertFalse($result->isValid());
    }

    /**
     * Too long.
     *
     * Test that string is too long and a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::__construct()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::validate()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getMin()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getMax()
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::getTemplates()
     */
    public function testTooLong(): void
    {
        $validator = new LengthValidator(null, 10);
        $result = $validator->validate('foo bar baz');

        $this->assertFalse($result->isValid());
    }

    /**
     * Not string.
     *
     * Test that none string value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::validate()
     */
    public function testNotString(): void
    {
        $validator = new LengthValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Text\LengthValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = LengthValidator::factory(LengthValidator::class, $serviceLocator, [
            'min' => 5,
            'max' => 10,
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
