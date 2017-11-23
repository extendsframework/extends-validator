<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Format;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class RegexValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that valid uuid value will validate against regular expression.
     *
     * @covers \ExtendsFramework\Validator\Format\RegexValidator::__construct()
     * @covers \ExtendsFramework\Validator\Format\RegexValidator::validate()
     */
    public function testValid(): void
    {
        $validator = new RegexValidator('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $result = $validator->validate('db6eb6f2-1dda-4f06-a995-1fd1aca99e1f');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that invalid uuid value will not validate against regular expression.
     *
     * @covers \ExtendsFramework\Validator\Format\RegexValidator::__construct()
     * @covers \ExtendsFramework\Validator\Format\RegexValidator::validate()
     * @covers \ExtendsFramework\Validator\Format\RegexValidator::getTemplates()
     */
    public function testInvalid(): void
    {
        $validator = new RegexValidator('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i');
        $result = $validator->validate('foo-bar-baz');

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns an instanceof of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Format\RegexValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = RegexValidator::factory(RegexValidator::class, $serviceLocator, [
            'pattern' => '/a/',
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
