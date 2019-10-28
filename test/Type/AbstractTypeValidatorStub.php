<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class AbstractTypeValidatorStub extends AbstractTypeValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        return $this->getValidResult();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
