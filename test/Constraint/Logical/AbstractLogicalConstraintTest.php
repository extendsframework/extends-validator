<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class AbstractLogicalConstraintTest extends TestCase
{
    /**
     * Factory.
     *
     * Test that factory returns a AbstractLogicalConstraint.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::factory()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::addConstraint()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->expects($this->once())
            ->method('getService')
            ->with(
                ConstraintInterface::class,
                []
            )
            ->willReturn($this->createMock(ConstraintInterface::class));

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $constraint = LogicalConstraintStub::factory(ConstraintInterface::class, $serviceLocator, [
            'constraints' => [
                [
                    'name' => ConstraintInterface::class,
                ],
            ],
        ]);

        $this->assertInstanceOf(ConstraintInterface::class, $constraint);
    }
}

class LogicalConstraintStub extends AbstractLogicalConstraint
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ?ConstraintViolationInterface
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
