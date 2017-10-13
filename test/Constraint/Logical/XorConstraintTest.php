<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint\Logical;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use ExtendsFramework\Validator\Constraint\ConstraintViolationInterface;
use PHPUnit\Framework\TestCase;

class XorConstraintTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that only one of the inner constraints is valid and null will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\XorConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::addConstraint()
     */
    public function testValid(): void
    {
        $innerConstraint = $this->createMock(ConstraintInterface::class);
        $innerConstraint
            ->expects($this->exactly(4))
            ->method('validate')
            ->with('foo', ['bar' => 'baz'])
            ->willReturnOnConsecutiveCalls(
                $this->createMock(ConstraintViolationInterface::class),
                $this->createMock(ConstraintViolationInterface::class),
                null,
                $this->createMock(ConstraintViolationInterface::class)
            );

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new XorConstraint();
        $result = $constraint
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertNull($result);
    }

    /**
     * None valid.
     *
     * Test that none of the inner constraints are valid and a violation will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\XorConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\XorConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::addConstraint()
     */
    public function testNoneValid(): void
    {
        $violation = $this->createMock(ConstraintViolationInterface::class);

        $innerConstraint = $this->createMock(ConstraintInterface::class);
        $innerConstraint
            ->expects($this->exactly(4))
            ->method('validate')
            ->with('foo', ['bar' => 'baz'])
            ->willReturnOnConsecutiveCalls(
                $violation,
                $violation,
                $violation,
                $violation
            );

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new XorConstraint();
        $result = $constraint
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('None of the {{count}} constraint(s) are valid.', $result->getMessage());
            $this->assertSame([
                'count' => 4,
            ], $result->getParameters());
        }
    }

    /**
     * Multiple valid.
     *
     * Test that multiple of the inner constraints are valid and a violation will be returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\Logical\XorConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\XorConstraint::getTemplates()
     * @covers \ExtendsFramework\Validator\Constraint\Logical\AbstractLogicalConstraint::addConstraint()
     */
    public function testMultipleValid(): void
    {
        $violation = $this->createMock(ConstraintViolationInterface::class);

        $innerConstraint = $this->createMock(ConstraintInterface::class);
        $innerConstraint
            ->expects($this->exactly(4))
            ->method('validate')
            ->with('foo', ['bar' => 'baz'])
            ->willReturnOnConsecutiveCalls(
                $violation,
                null,
                null,
                $violation
            );

        /**
         * @var ConstraintInterface $innerConstraint
         */
        $constraint = new XorConstraint();
        $result = $constraint
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->addConstraint($innerConstraint)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertInstanceOf(ConstraintViolationInterface::class, $result);
        if ($result instanceof ConstraintViolationInterface) {
            $this->assertSame('Multiple of the {{count}} constraint(s) are valid.', $result->getMessage());
            $this->assertSame([
                'count' => 4,
            ], $result->getParameters());
        }
    }
}
