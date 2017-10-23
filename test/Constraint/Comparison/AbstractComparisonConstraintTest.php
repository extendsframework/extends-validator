<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class AbstractComparisonConstraintTest extends TestCase
{
    /**
     * Factory.
     *
     * Test that factory returns a AbstractComparisonConstraint.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $constraint = ComparisonConstraintStub::factory(ConstraintInterface::class, $serviceLocator);

        $this->assertInstanceOf(ConstraintInterface::class, $constraint);
    }
}

class ComparisonConstraintStub extends AbstractComparisonConstraint
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
