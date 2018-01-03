<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Validator\Result\Container\ContainerResult;
use ExtendsFramework\Validator\Result\ResultInterface;
use PHPUnit\Framework\TestCase;

class ContainerValidatorTest extends TestCase
{
    /**
     * Validate.
     *
     * Test that sub validators will be validated and a result container will be returned.
     *
     * @covers \ExtendsFramework\Validator\ContainerValidator::addValidator()
     * @covers \ExtendsFramework\Validator\ContainerValidator::getValidators()
     * @covers \ExtendsFramework\Validator\ContainerValidator::validate()
     */
    public function testValidate(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->exactly(5))
            ->method('isValid')
            ->willReturnOnConsecutiveCalls(
                true,
                true,
                false,
                false,
                false
            );

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->exactly(3))
            ->method('validate')
            ->with('foo', 'bar')
            ->willReturn($result);

        /**
         * @var ValidatorInterface $validator
         */
        $container = new ContainerValidator();
        $result = $container
            ->addValidator($validator)
            ->addValidator($validator)
            ->addValidator($validator, true)
            ->addValidator($validator)
            ->validate('foo', 'bar');

        $this->assertInstanceOf(ContainerResult::class, $result);
        if ($result instanceof ContainerResult) {
            $this->assertFalse($result->isValid());
        }
    }
}
