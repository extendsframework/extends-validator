<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class AbstractTypeValidatorTest extends TestCase
{
    /**
     * Factory.
     *
     * Test that factory returns a AbstractTypeValidator.
     *
     * @covers \ExtendsFramework\Validator\Type\AbstractTypeValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = AbstractTypeValidatorStub::factory(AbstractTypeValidatorStub::class, $serviceLocator);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
