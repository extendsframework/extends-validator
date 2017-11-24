<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Properties;

use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class PropertyTest extends TestCase
{
    /**
     * Get methods.
     *
     * Test that get methods will return correct values.
     *
     * @covers \ExtendsFramework\Validator\Other\Properties\Property::__construct()
     * @covers \ExtendsFramework\Validator\Other\Properties\Property::getName()
     * @covers \ExtendsFramework\Validator\Other\Properties\Property::getValidator()
     * @covers \ExtendsFramework\Validator\Other\Properties\Property::isOptional()
     */
    public function testGetMethods(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);

        /**
         * @var ValidatorInterface $validator
         */
        $property = new Property('foo', $validator, false);

        $this->assertSame('foo', $property->getName());
        $this->assertSame($validator, $property->getValidator());
        $this->assertSame(false, $property->isOptional());
    }
}
