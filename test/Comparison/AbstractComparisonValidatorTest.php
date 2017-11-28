<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class AbstractComparisonValidatorTest extends TestCase
{
    /**
     * Validate.
     *
     * Test that method will validate value and return result.
     *
     * @covers \ExtendsFramework\Validator\Comparison\AbstractComparisonValidator::__construct()
     * @covers \ExtendsFramework\Validator\Comparison\AbstractComparisonValidator::validate()
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
     * @covers \ExtendsFramework\Validator\Comparison\AbstractComparisonValidator::factory()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = NumberValidatorStub::factory(ValidatorInterface::class, $serviceLocator, [
            'subject' => 5.5,
        ]);

        $this->assertInstanceOf(ValidatorInterface::class, $validator);
    }
}

class NumberValidatorStub extends AbstractComparisonValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        return $this->getValidResult();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
