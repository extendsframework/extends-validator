<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class CollectionValidatorTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that collection will be valid.
     *
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::__construct()
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::validate()
     */
    public function testValid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->any())
            ->method('isValid')
            ->willReturn(true);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->exactly(3))
            ->method('validate')
            ->with('foo', 'bar')
            ->willReturn($result);

        /**
         * @var ValidatorInterface $validator
         */
        $collection = new CollectionValidator($validator);
        $result = $collection->validate([
            'foo',
            'foo',
            'foo',
        ], 'bar');

        $this->assertTrue($result->isValid());
    }

    /**
     * Invalid.
     *
     * Test that collection will be invalid.
     *
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::__construct()
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::validate()
     */
    public function testInvalid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->any())
            ->method('isValid')
            ->willReturn(false);

        $validator = $this->createMock(ValidatorInterface::class);
        $validator
            ->expects($this->exactly(3))
            ->method('validate')
            ->with('foo', 'bar')
            ->willReturn($result);

        /**
         * @var ValidatorInterface $validator
         */
        $collection = new CollectionValidator($validator);
        $result = $collection->validate([
            'foo',
            'foo',
            'foo',
        ], 'bar');

        $this->assertFalse($result->isValid());
    }

    /**
     * Not iterable.
     *
     * Test that collection will be invalid when value is not iterable.
     *
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::__construct()
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::validate()
     */
    public function testNotIterable(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);

        /**
         * @var ValidatorInterface $validator
         */
        $collection = new CollectionValidator($validator);
        $result = $collection->validate(9);

        $this->assertFalse($result->isValid());
    }

    /**
     * Factory.
     *
     * Test that factory returns a AbstractTypeValidator.
     *
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::factory()
     * @covers \ExtendsFramework\Validator\Other\CollectionValidator::__construct()
     */
    public function testFactory(): void
    {
        $serviceLocator = $this->createMock(ServiceLocatorInterface::class);
        $serviceLocator
            ->expects($this->once())
            ->method('getService')
            ->with(ValidatorInterface::class, ['foo' => 'bar'])
            ->willReturn($this->createMock(ValidatorInterface::class));

        /**
         * @var ServiceLocatorInterface $serviceLocator
         */
        $validator = CollectionValidator::factory(CollectionValidator::class, $serviceLocator, [
            'validator' => [
                'name' => ValidatorInterface::class,
                'options' => [
                    'foo' => 'bar',
                ],
            ],
        ]);

        $this->assertInstanceOf(CollectionValidator::class, $validator);
    }
}
