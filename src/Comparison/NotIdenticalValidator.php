<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class NotIdenticalValidator extends AbstractComparisonValidator
{
    /**
     * When value is not identical to context.
     *
     * @const string
     */
    public const IS_IDENTICAL = 'identical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value !== $context) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::IS_IDENTICAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::IS_IDENTICAL => 'Value is identical to context.',
        ];
    }
}
