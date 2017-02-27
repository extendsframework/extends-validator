<?php
declare(strict_types = 1);

namespace ExtendsFramework\Validator\Constraint\Type;

use ExtendsFramework\Validator\Constraint\AbstractConstraint;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;
use PHPUnit\Framework\TestCase;

class AbstractConstraintTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     */
    public function testCanValidateAssert(): void
    {
        $constraint = $this->getMockForAbstractClass(AbstractConstraint::class);
        $constraint
            ->expects($this->once())
            ->method('assert')
            ->with('foo', []);

        /**
         * @var AbstractConstraint $constraint
         */
        $valid = $constraint->validate('foo', []);

        $this->assertTrue($valid);
    }

    /**
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     */
    public function testCanCatchViolationException(): void
    {
        $constraint = $this->getMockForAbstractClass(AbstractConstraint::class);
        $constraint
            ->expects($this->once())
            ->method('assert')
            ->with('foo', [])
            ->willThrowException(new ConstraintViolation('Value must be valid.', []));

        /**
         * @var AbstractConstraint $constraint
         */
        $valid = $constraint->validate('foo', []);

        $this->assertFalse($valid);
    }

    /**
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Exception\TemplateNotFound::forKey
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\TemplateNotFound
     * @expectedExceptionMessage Template MUST exist for key "foo".
     */
    public function testCanNotGetTemplateForKey(): void
    {
        $constraint = new class extends AbstractConstraint
        {
            /**
             * @inheritDoc
             */
            public function assert($value, $context = null): void
            {
                throw $this->getViolation('foo', []);
            }

            /**
             * @inheritDoc
             */
            protected function getTemplates(): array
            {
                return [];
            }
        };
        $constraint->assert('foo');
    }
}
