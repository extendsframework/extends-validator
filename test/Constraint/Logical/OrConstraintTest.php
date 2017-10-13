<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class OrConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that one of the inner constraints are valid and null will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\OrConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::addConstraint()
     */
    public function testValid(): void
    {
        $innerConstraint = $this->createMock(ConstraintInterface::class);
        $innerConstraint
            ->expects($this->exactly(2))
            ->method('validate')
            ->withConsecutive(
                ['foo', ['bar' => 'baz']],
                ['foo', ['bar' => 'baz']]
            )
            ->willReturnOnConsecutiveCalls(
                $this->createMock(ConstraintViolationInterface::class),
                null
            );

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new OrConstraint();
        $result = $constraint
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertNull($result);
    }

    /**
     * Invalid.
     *
     * Test that one of the inner constraints are valid and a violation will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\OrConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\OrConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::addConstraint()
     */
    public function testInvalid(): void
    {
        $violation = $this->createMock(ConstraintViolationInterface::class);

        $innerConstraint = $this->createMock(ConstraintInterface::class);
        $innerConstraint
            ->expects($this->exactly(2))
            ->method('validate')
            ->withConsecutive(
                ['foo', ['bar' => 'baz']],
                ['foo', ['bar' => 'baz']]
            )
            ->willReturnOnConsecutiveCalls(
                $violation,
                $violation
            );

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new OrConstraint();
        $result = $constraint
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('None of the {{count}} constraint(s) are valid.', $result->getMessage());
            $this->assertSame([
                'count' => 2,
            ], $result->getParameters());
        }
    }
}
