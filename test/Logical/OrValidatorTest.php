<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class OrValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that one of the inner validators are valid.
     *
     * @covers \ExtendsFramework\Validator\Logical\OrValidator::validate()
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::addValidator()
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::getValidators()
     */
    public function testValid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->exactly(2))
            ->method('isValid')
            ->willReturnOnConsecutiveCalls(
                false,
                true
            );

        $innerValidator = $this->createMock(ValidatorInterface::class);
        $innerValidator
            ->expects($this->exactly(2))
            ->method('validate')
            ->withConsecutive(
                ['foo', ['bar' => 'baz']],
                ['foo', ['bar' => 'baz']]
            )
            ->willReturn($result);

        /**
         * @var ValidatorInterface $innerValidator
         */
        $validator = new OrValidator();
        $result = $validator
            ->addValidator($innerValidator)
            ->addValidator($innerValidator)
            ->addValidator($innerValidator)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that one of the inner validators are valid.
     *
     * @covers \ExtendsFramework\Validator\Logical\OrValidator::validate()
     * @covers \ExtendsFramework\Validator\Logical\OrValidator::getTemplates()
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::addValidator()
     * @covers \ExtendsFramework\Validator\Logical\AbstractLogicalValidator::getValidators()
     */
    public function testInvalid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->exactly(2))
            ->method('isValid')
            ->willReturnOnConsecutiveCalls(
                false,
                false
            );

        $innerValidator = $this->createMock(ValidatorInterface::class);
        $innerValidator
            ->expects($this->exactly(2))
            ->method('validate')
            ->withConsecutive(
                ['foo', ['bar' => 'baz']],
                ['foo', ['bar' => 'baz']]
            )
            ->willReturn($result);

        /**
         * @var ValidatorInterface $innerValidator
         */
        $validator = new OrValidator();
        $result = $validator
            ->addValidator($innerValidator)
            ->addValidator($innerValidator)
            ->validate('foo', ['bar' => 'baz']);

        $this->assertFalse($result->isValid());
    }
}
