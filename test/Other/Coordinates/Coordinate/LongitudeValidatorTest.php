<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Coordinates\Coordinate;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class LongitudeValidatorTest extends TestCase
{
    /**
     * Valid longitude coordinate values.
     *
     * @return array
     */
    public function validLongitudeValuesProvider(): array
    {
        return [
            [-90],
            [-52.0767034],
            [0],
            [52.0767034],
            [90],
        ];
    }

    /**
     * Valid.
     *
     * Test that longitude values are valid.
     *
     * @param mixed $longitude
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::validate()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::getMin()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::getMax()
     * @dataProvider validLongitudeValuesProvider
     */
    public function testValid($longitude): void
    {
        $validator = new LongitudeValidator();
        $result = $validator->validate($longitude);

        $this->assertTrue($result->isValid());
    }

    /**
     * Valid longitude coordinate values.
     *
     * @return array
     */
    public function invalidLongitudeValuesProvider(): array
    {
        return [
            [-100],
            [-90.1],
            [90.1],
            [100],
        ];
    }

    /**
     * Valid.
     *
     * Test that longitude values are valid.
     *
     * @param mixed $longitude
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::validate()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::getMin()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::getMax()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::getTemplates()
     * @dataProvider invalidLongitudeValuesProvider
     */
    public function testInvalid($longitude): void
    {
        $validator = new LongitudeValidator();
        $result = $validator->validate($longitude);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not number.
     *
     * Test that longitude must be a number.
     *
     * @covers \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::validate()
     */
    public function testNotNumber(): void
    {
        $validator = new LongitudeValidator();
        $result = $validator->validate('foo');

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns correct instance.
     *
     * @covers \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = LongitudeValidator::factory(LongitudeValidator::class, $serviceLocator, []);

        $this->assertInstanceOf(LongitudeValidator::class, $validator);
    }
}
