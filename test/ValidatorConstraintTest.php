<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Constraint\ConstraintInterface;
use PHPUnit\Framework\TestCase;

class ValidatorConstraintTest extends TestCase
{
    /**
     * Get methods.
     *
     * Test that get methods will return correct values.
     *
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::__construct()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::getConstraint()
     * @covers \ExtendsFramework\Validator\ValidatorConstraint::mustInterrupt()
     */
    public function testGetMethods(): void
    {
        $constraint = $this->createMock(ConstraintInterface::class);

        /**
         * @var ConstraintInterface $constraint
         */
        $validatorConstraint = new ValidatorConstraint($constraint, true);

        $this->assertSame($constraint, $validatorConstraint->getConstraint());
        $this->assertTrue($validatorConstraint->mustInterrupt());
    }
}
