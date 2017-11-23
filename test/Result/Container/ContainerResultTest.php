<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Result\Container;

use ExtendsFramework\Validator\Result\ResultInterface;
use PHPUnit\Framework\TestCase;

class ContainerResultTest extends TestCase
{
    /**
     * Valid.
     *
     * Test that container is valid when all results are valid.
     *
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::addResult()
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::isValid()
     */
    public function testIsValid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->exactly(3))
            ->method('isValid')
            ->willReturn(true);

        /**
         * @var ResultInterface $result
         */
        $container = new ContainerResult();
        $valid = $container
            ->addResult($result, 'foo')
            ->addResult($result)
            ->addResult($result, 'bar')
            ->isValid();

        $this->assertTrue($valid);
    }

    /**
     * Invalid.
     *
     * Test that container is valid when all results are valid.
     *
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::addResult()
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::isValid()
     */
    public function testInvalid(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->exactly(2))
            ->method('isValid')
            ->willReturnOnConsecutiveCalls(
                true,
                false
            );

        /**
         * @var ResultInterface $result
         */
        $container = new ContainerResult();
        $valid = $container
            ->addResult($result)
            ->addResult($result, 'foo')
            ->addResult($result)
            ->isValid();

        $this->assertFalse($valid);
    }

    /**
     * JSON serialize.
     *
     * Test that methods will correct data.
     *
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::addResult()
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::isValid()
     * @covers \ExtendsFramework\Validator\Result\Container\ContainerResult::jsonSerialize()
     */
    public function testJsonSerialize(): void
    {
        $result = $this->createMock(ResultInterface::class);
        $result
            ->expects($this->once())
            ->method('isValid')
            ->willReturn(false);

        /**
         * @var ResultInterface $result
         */
        $container = new ContainerResult();
        $json = $container
            ->addResult($result)
            ->addResult($result, 'foo')
            ->addResult($result)
            ->jsonSerialize();

        $this->assertSame([
            $result,
            'foo' => $result,
            $result,
        ], $json);
    }
}
