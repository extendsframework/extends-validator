<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class ValidatorFactoryTest extends TestCase
{
    /**
     * Create service.
     *
     * Test that factory will return an instance of ValidatorInterface.
     *
     * @covers \ExtendsFramework\Validator\Framework\ServiceLocator\Factory\Validator\ValidatorFactory::createService()
     */
    public function testCreateService(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->expects($this->once())
            ->method('getService')
            ->with(ConstraintInterface::class, [])
            ->willReturn($this->createMock(ConstraintInterface::class));

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $factory = new ValidatorFactory();
        $validator = $factory->createService(ValidatorInterface::class, $serviceLocator, [
            'constraints' => [
                [
                    'name' => ConstraintInterface::class,
                ],
            ],
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
