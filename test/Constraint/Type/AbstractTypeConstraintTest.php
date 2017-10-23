<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class AbstractTypeConstraintTest extends TestCase
{
    /**
     * Factory.
     *
     * Test that factory returns a AbstractTypeConstraint.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Type\AbstractTypeConstraint::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $constraint = TypeConstraintStub::factory(TypeConstraintStub::class, $serviceLocator);

        $this->assertInstanceOf(ConstraintInterface::class, $constraint);
    }
}

class TypeConstraintStub extends AbstractTypeConstraint
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
