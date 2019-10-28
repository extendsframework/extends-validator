<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class AbstractComparisonValidatorStub extends AbstractComparisonValidator
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
