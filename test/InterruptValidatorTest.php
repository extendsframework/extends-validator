<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Result\ResultInterface;
use PHPUnit\Framework\TestCase;

class InterruptValidatorTest extends TestCase
{
    /**
     * Validate.
     *
     * Test that get method will return correct values and validate calls inner validator validate method.
     *
     * @covers \ExtendsFramework\Validator\InterruptValidator::__construct()
     * @covers \ExtendsFramework\Validator\InterruptValidator::validate()
     * @covers \ExtendsFramework\Validator\InterruptValidator::getValidator()
     * @covers \ExtendsFramework\Validator\InterruptValidator::mustInterrupt()
     */
    public function testValidate(): void
    {
        $result = $this->createMock(ResultInterface::class);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->once())
            ->method('validate')
            ->with('foo', 'bar')
            ->willReturn($result);

        /**
         * @var ValidatorInterface $validator
         */
        $interrupt = new InterruptValidator($validator, true);

        $this->assertSame($result, $interrupt->validate('foo', 'bar'));
        $this->assertTrue($interrupt->mustInterrupt());
    }
}
