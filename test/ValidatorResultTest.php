<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use PHPUnit\Framework\TestCase;

class ValidatorResultTest extends TestCase
{
    /**
     * Get methods.
     *
     * Test that get methods will return correct values.
     *
     * @covers \ExtendsFramework\Validator\ValidatorResult::__construct()
     * @covers \ExtendsFramework\Validator\ValidatorResult::isValid()
     * @covers \ExtendsFramework\Validator\ValidatorResult::getViolations()
     */
    public function testGetMethods(): void
    {
        $result = new ValidatorResult(true, ['foo' => 'bar']);

        $this->assertTrue($result->isValid());
        $this->assertSame(['foo' => 'bar'], $result->getViolations());
    }
}
