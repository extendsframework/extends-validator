<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Coordinates\Coordinate;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class LatitudeValidatorTest extends TestCase
{
    /**
     * Valid latitude coordinate values.
     *
     * @return array
     */
    public function validLatitudeValuesProvider(): array
    {
        return [
            [-180],
            [-52.0767034],
            [0],
            [52.0767034],
            [180],
        ];
    }

    /**
     * Valid.
     *
     * Test that latitude values are valid.
     *
     * @param mixed $latitude
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::validate()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::getMin()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::getMax()
     * @dataProvider validLatitudeValuesProvider
     */
    public function testValid($latitude): void
    {
        $validator = new LatitudeValidator();
        $result = $validator->validate($latitude);

        $this->assertTrue($result->isValid());
    }

    /**
     * Valid latitude coordinate values.
     *
     * @return array
     */
    public function invalidLatitudeValuesProvider(): array
    {
        return [
            [-190],
            [-180.1],
            [180.1],
            [190],
        ];
    }

    /**
     * Valid.
     *
     * Test that latitude values are valid.
     *
     * @param mixed $latitude
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::validate()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::getMin()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::getMax()
     * @covers       \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::getTemplates()
     * @dataProvider invalidLatitudeValuesProvider
     */
    public function testInvalid($latitude): void
    {
        $validator = new LatitudeValidator();
        $result = $validator->validate($latitude);

        $this->assertFalse($result->isValid());
    }

    /**
     * Not number.
     *
     * Test that latitude must be a number.
     *
     * @covers \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::validate()
     */
    public function testNotNumber(): void
    {
        $validator = new LatitudeValidator();
        $result = $validator->validate('foo');

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns correct instance.
     *
     * @covers \ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = LatitudeValidator::factory(LatitudeValidator::class, $serviceLocator, []);

        $this->assertInstanceOf(LatitudeValidator::class, $validator);
    }
}
