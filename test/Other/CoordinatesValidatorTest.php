<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;
use stdClass;

class CoordinatesValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that latitude and longitude are valid.
     *
     * @covers \ExtendsFramework\Validator\Other\CoordinatesValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new CoordinatesValidator();
        $result = $validator->validate((object)[
            'latitude' => 52.0767034,
            'longitude' => 5.4777887,
        ]);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid latitude
     *
     * Test that latitude is invalid value and a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Other\CoordinatesValidator::validate()
     * @covers \ExtendsFramework\Validator\Other\CoordinatesValidator::getTemplates()
     */
    public function testInvalidLatitude(): void
    {
        $validator = new CoordinatesValidator();
        $result = $validator->validate((object)[
            'latitude' => 200,
            'longitude' => 5.4777887,
        ]);

        $this->assertFalse($result->isValid());
    }

    /**
     * Invalid longitude
     *
     * Test that longitude is invalid value and a invalid result will be returned.
     *
     * @covers \ExtendsFramework\Validator\Other\CoordinatesValidator::validate()
     * @covers \ExtendsFramework\Validator\Other\CoordinatesValidator::getTemplates()
     */
    public function testInvalidLongitude(): void
    {
        $validator = new CoordinatesValidator();
        $result = $validator->validate((object)[
            'latitude' => 52.0767034,
            'longitude' => 100,
        ]);

        $this->assertFalse($result->isValid());
    }

    /**
     * Invalid coordinates object provider.
     *
     * @return array
     */
    public function invalidCoordinatesObjectProvider(): array
    {
        return [
            [
                (object)[
                    'latitude' => 52.0767034,
                ],
            ],
            [
                (object)[
                    'longitude' => 5.4777887,
                ],
            ],
            [
                new stdClass(),
            ],
            [
                (object)[
                    'latitude' => 'foo',
                    'longitude' => 'bar',
                ],
            ],
        ];
    }

    /**
     * Invalid coordinates object.
     *
     * Test that coordinates object is invalid and an invalid result will be returned.
     *
     * @param mixed $coordinates
     * @covers       \ExtendsFramework\Validator\Other\CoordinatesValidator::validate()
     * @dataProvider invalidCoordinatesObjectProvider
     */
    public function testInvalidCoordinatesObject($coordinates)
    {
        $validator = new CoordinatesValidator();
        $result = $validator->validate($coordinates);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns correct instance.
     *
     * @covers \ExtendsFramework\Validator\Other\CoordinatesValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = CoordinatesValidator::factory(CoordinatesValidator::class, $serviceLocator, []);

        $this->assertInstanceOf(CoordinatesValidator::class, $validator);
    }
}
