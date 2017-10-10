<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

use PHPUnit\Framework\TestCase;

class AbstractConstraintTest extends TestCase
{
    /**
     * Template not found.
     *
     * Test that exception TemplateNotFound will be thrown when template for key 'foo' can not be found.
     *
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     * @covers                   \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     * @covers                   \ExtendsFramework\Validator\Constraint\Exception\TemplateNotFound::__construct()
     * @expectedException        \ExtendsFramework\Validator\Constraint\Exception\TemplateNotFound
     * @expectedExceptionMessage No constraint violation template found for key "foo".
     */
    public function testTemplateNotFound(): void
    {
        $constraint = new class extends AbstractConstraint
        {
            /**
             * @inheritDoc
             */
            public function validate($value, $context = null): ?ConstraintViolationInterface
            {
                return $this->getViolation('foo', []);
            }

            /**
             * @inheritDoc
             */
            protected function getTemplates(): array
            {
                return [];
            }
        };

        $constraint->validate('foo');
    }
}
