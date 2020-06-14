<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Boolean;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class FalseValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that value equals false.
     *
     * @covers \ExtendsFramework\Validator\Boolean\FalseValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new FalseValidator();

        $this->assertTrue($validator->validate(false)->isValid());
    }

    /**
     * Invalid.
     *
     * Test that value not equals false.
     *
     * @covers \ExtendsFramework\Validator\Boolean\FalseValidator::validate()
     * @covers \ExtendsFramework\Validator\Boolean\FalseValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new FalseValidator();

        $this->assertFalse($validator->validate(true)->isValid());
    }

    /**
     * Invalid.
     *
     * Test that none boolean value will not validate.
     *
     * @covers \ExtendsFramework\Validator\Boolean\FalseValidator::validate()
     */
    public function testNotBoolean(): void
    {
        $validator = new FalseValidator();
        $result = $validator->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Boolean\FalseValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = FalseValidator::factory(FalseValidator::class, $serviceLocator);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
