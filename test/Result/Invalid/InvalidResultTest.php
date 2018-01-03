<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Result\Invalid;

use PHPUnit\Framework\TestCase;

class InvalidResultTest extends TestCase
{
    /**
     * Methods.
     *
     * Test that methods return correct values.
     *
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::__construct()
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::isValid()
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::jsonSerialize()
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::getCode()
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::getMessage()
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::getParameters()
     * @covers \ExtendsFramework\Validator\Result\Invalid\InvalidResult::__toString()
     */
    public function testMethods(): void
    {
        $result = new InvalidResult('notString', 'Value is not a string, got "{{type}}".', [
            'type' => 'array',
        ]);

        $this->assertFalse($result->isValid());
        $this->assertSame([
            'code' => 'notString',
            'message' => 'Value is not a string, got "{{type}}".',
            'parameters' => [
                'type' => 'array',
            ],
        ], $result->jsonSerialize());
        $this->assertSame('Value is not a string, got "array".', (string)$result);
    }
}
