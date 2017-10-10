<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Constraint;

use PHPUnit\Framework\TestCase;

class AbstractConstraintTest extends TestCase
{
    /**
     * Template found.
     *
     * Test that template is found and a ConstraintViolationInterface instance is returned.
     *
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::validate()
     * @covers \ExtendsFramework\Validator\Constraint\AbstractConstraint::getViolation()
     */
    public function testTemplateFound(): void
    {
        $constraint = new class extends AbstractConstraint
        {
            /**
             * @inheritDoc
             */
            public function validate($value, $context = null): ?ConstraintViolationInterface
            {
                return $this->getViolation('foo', [
                    'bar' => 'baz',
                ]);
            }

            /**
             * @inheritDoc
             */
            protected function getTemplates(): array
            {
                return [
                    'foo' => 'Hello {{bar]}!',
                ];
            }
        };

        $violation = $constraint->validate('foo');

        $this->assertInstanceOf(ConstraintViolationInterface::class, $violation);
        if ($violation instanceof ConstraintViolationInterface) {
            $this->assertSame('Hello {{bar]}!', $violation->getMessage());
            $this->assertSame([
                'bar' => 'baz',
            ], $violation->getParameters());
        }
    }

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
