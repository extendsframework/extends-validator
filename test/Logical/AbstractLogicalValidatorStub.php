<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\Validator\Result\ResultInterface;

class AbstractLogicalValidatorStub extends AbstractLogicalValidator
{
    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [];
    }
}
