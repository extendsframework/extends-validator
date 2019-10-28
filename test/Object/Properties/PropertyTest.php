<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Object\Properties;

use ExtendsFramework\Validator\ValidatorInterface;
use PHPUnit\Framework\TestCase;

class PropertyTest extends TestCase
{
    /**
     * Get methods.
     *
     * Test that get methods will return correct values.
     *
     * @covers \ExtendsFramework\Validator\Object\Properties\Property::__construct()
     * @covers \ExtendsFramework\Validator\Object\Properties\Property::getName()
     * @covers \ExtendsFramework\Validator\Object\Properties\Property::getValidator()
     * @covers \ExtendsFramework\Validator\Object\Properties\Property::isOptional()
     */
    public function testGetMethods(): void
    {
        $validator = $this->createMock(ValidatorInterface::class);

        /**
         * @var ValidatorInterface $validator
         */
        $property = new Property('foo', $validator);

        $this->assertSame('foo', $property->getName());
        $this->assertSame($validator, $property->getValidator());
        $this->assertFalse($property->isOptional());
    }
}
