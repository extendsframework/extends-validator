<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Collection;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class SizeValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that collection size is in expected range and a valid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::__construct()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::validate()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMin()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMax()
     */
    public function testValid(): void
    {
        $validator = new SizeValidator(5, 15);
        $result = $validator->validate([
            1,
            2,
            3,
            4,
            5,
            6,
            7,
        ]);

        $this->assertTrue($result->isValid());
    }

    /**
     * Too few.
     *
     * Test that collection has too few items and a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::__construct()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::validate()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMin()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMax()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getTemplates()
     */
    public function testTooShort(): void
    {
        $validator = new SizeValidator(5);
        $result = $validator->validate([
            1,
            2,
            3,
        ]);

        $this->assertFalse($result->isValid());
    }

    /**
     * Too many.
     *
     * Test that collection has too many items and a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::__construct()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::validate()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMin()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMax()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getTemplates()
     */
    public function testTooLong(): void
    {
        $validator = new SizeValidator(null, 5);
        $result = $validator->validate([
            1,
            2,
            3,
            4,
            5,
            6,
            7,
        ]);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not array.
     *
     * Test that none array value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::validate()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMin()
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::getMax()
     */
    public function testNotArray(): void
    {
        $validator = new SizeValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Collection\SizeValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = SizeValidator::factory(SizeValidator::class, $serviceLocator, [
            'min' => 5,
            'max' => 10,
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
