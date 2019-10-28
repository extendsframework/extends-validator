<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\Result\ResultInterface;

class ValidatorStub extends AbstractValidator
{
    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($context === true) {
            return $this->getValidResult();
        }
        if ($context === false) {
            return $this->getInvalidResult('bar', []);
        }

        return $this->getInvalidResult('foo', []);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            'bar' => 'Fancy error message.',
        ];
    }
}
