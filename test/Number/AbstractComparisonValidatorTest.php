<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class AbstractComparisonValidatorTest extends TestCase
{
    /**
     * Validate.
     *
     * Test that method will validate value and return result.
     *
     * @covers \ExtendsFramework\Validator\Number\AbstractNumberValidator::__construct()
     * @covers \ExtendsFramework\Validator\Number\AbstractNumberValidator::validate()
     */
    public function testValidate(): void
    {
        $validator = new NumberValidatorStub(3);
        $result = $validator->validate(3);

        $this->assertTrue($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns a AbstractComparisonValidator.
     *
     * @covers \ExtendsFramework\Validator\Number\AbstractNumberValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = NumberValidatorStub::factory(ValidatorInterface::class, $serviceLocator, [
            'number' => 5.5,
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}

class NumberValidatorStub extends AbstractNumberValidator
{
    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
