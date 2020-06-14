<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Boolean;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class TrueValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that value equals true.
     *
     * @covers \ExtendsFramework\Validator\Boolean\TrueValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new TrueValidator();

        $this->assertTrue($validator->validate(true)->isValid());
    }

    /**
     * Invalid.
     *
     * Test that value not equals true.
     *
     * @covers \ExtendsFramework\Validator\Boolean\TrueValidator::validate()
     * @covers \ExtendsFramework\Validator\Boolean\TrueValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new TrueValidator();

        $this->assertFalse($validator->validate(false)->isValid());
    }

    /**
     * Invalid.
     *
     * Test that none boolean value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Boolean\TrueValidator::validate()
     */
    public function testNotBoolean(): void
    {
        $validator = new TrueValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Boolean\TrueValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = TrueValidator::factory(TrueValidator::class, $serviceLocator);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
