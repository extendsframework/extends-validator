<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Callback;

use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class CallbackValidatorTest extends TestCase
{
    /**
     * Validate.
     *
     * Test that validate will proxy to callback.
     *
     * @covers \ExtendsFramework\Validator\Other\Callback\CallbackValidator::__construct()
     * @covers \ExtendsFramework\Validator\Other\Callback\CallbackValidator::validate()
     */
    public function testValidate(): void
    {
        $result = $this->createMock(ResultInterface::class);

        $inner = $this->createMock(ValidatorInterface::class);
        $inner
            ->expects($this->once())
            ->method('validate')
            ->with('foo', 'bar')
            ->willReturn($result);

        /**
         * @var ValidatorInterface $inner
         */
        $validator = new CallbackValidator(static function ($value, $context = null) use ($inner) {
            return $inner->validate($value, $context);
        });

        $this->assertSame($result, $validator->validate('foo', 'bar'));
    }
}
