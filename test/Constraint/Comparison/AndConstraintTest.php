<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Comparison;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class AndConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that all the inner constraints are valid and null will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AndConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::addConstraint()
     */
    public function testValid(): void
    {
        $innerConstraint = $this->createMock(ConstraintInterface::class);
        $innerConstraint
            ->expects($this->exactly(3))
            ->method('validate')
            ->with('foo', ['bar' => 'baz'])
            ->willReturn(null);

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new AndConstraint();
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
     * Test that one of the inner constraints are invalid and a violation will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AndConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Comparison\AbstractComparisonConstraint::addConstraint()
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
                null,
                $violation
            );

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new AndConstraint();
        $result = $constraint
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertSame($violation, $result);
    }
}
