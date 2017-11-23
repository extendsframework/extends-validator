<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class IdenticalValidator extends AbstractComparisonValidator
{
    /**
     * When value is not identical to context.
     *
     * @const string
     */
    public const NOT_IDENTICAL = 'notIdentical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value === $context) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_IDENTICAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_IDENTICAL => 'Value is not identical to context.',
        ];
    }
}
