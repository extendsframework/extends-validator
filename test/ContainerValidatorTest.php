<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\Container\ContainerInterface;
use ExtendsFramework\Validator\Constraint\Exception\ConstraintViolation;
use PHPUnit\Framework\TestCase;

class ContainerValidatorTest extends TestCase
{
    /**
     * @covers \ExtendsFramework\Validator\ContainerValidator::addValidator()
     * @covers \ExtendsFramework\Validator\ContainerValidator::validate()
     * @covers \ExtendsFramework\Validator\ContainerValidator::violations()
     */
    public function testCanValidateContainer(): void
    {
        $container = $this->createMock(ContainerInterface::class);
        $container
            ->expects($this->exactly(2))
            ->method('find')
            ->withConsecutive(['foo'], ['bar.baz'])
            ->willReturnOnConsecutiveCalls('qux', 'quux');

        $violation = $this->createMock(ConstraintViolation::class);

        $validator1 = $this->createMock(ValidatorInterface::class);
        $validator1
            ->expects($this->once())
            ->method('validate')
            ->with('qux', $container)
            ->willReturn(true);

        $validator2 = $this->createMock(ValidatorInterface::class);
        $validator2
            ->expects($this->once())
            ->method('validate')
            ->with('quux', $container)
            ->willReturn(false);

        $validator2
            ->expects($this->once())
            ->method('violations')
            ->willReturn([
                $violation,
            ]);

        /**
         * @var ValidatorInterface $validator1
         * @var ValidatorInterface $validator2
         * @var ContainerInterface $container
         */
        $validator = new ContainerValidator();
        $valid = $validator
            ->addValidator($validator1, 'foo')
            ->addValidator($validator2, 'bar.baz')
            ->validate($container);
        $violations = $validator->violations();

        $this->assertFalse($valid);
        $this->assertSame([
            'bar' => [
                'baz' => [
                    $violation,
                ],
            ],
        ], $violations->extract());
    }

    /**
     * @covers                   \ExtendsFramework\Validator\ContainerValidator::violations()
     * @covers                   \ExtendsFramework\Validator\Exception\ValidatorNotValidated::forContainer()
     * @expectedException        \ExtendsFramework\Validator\Exception\ValidatorNotValidated
     * @expectedExceptionMessage Container validator MUST be validated. Call validate() first.
     */
    public function testCanNotGetViolationsWhenNotValidated(): void
    {
        $validator = new ContainerValidator();
        $validator->violations();
    }
}
