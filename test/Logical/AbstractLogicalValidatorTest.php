<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class AbstractLogicalValidatorTest extends TestCase
{
    /**
     * Factory.
     *
     * Test that factory returns a AbstractLogicalValidator.
     *
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::factory()
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::__construct()
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::addValidator()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->expects($this->once())
            ->method('getService')
            ->with(
                ValidatorInterface::class,
                [
                    'foo' => 'bar',
                ]
            )
            ->willReturn($this->createMock(ValidatorInterface::class));

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = AbstractLogicalValidatorStub::factory(ValidatorInterface::class, $serviceLocator, [
            'validators' => [
                [
                    'name' => ValidatorInterface::class,
                    'options' => [
                        'foo' => 'bar',
                    ],
                ],
            ],
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}
