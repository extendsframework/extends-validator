<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class GreaterOrEqualValidator extends AbstractComparisonValidator
{
    /**
     * When value is not greater than or equal to context.
     *
     * @const string
     */
    public const NOT_GREATER_OR_EQUAL = 'notGreaterOrEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value >= $context) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_GREATER_OR_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_GREATER_OR_EQUAL => 'Value is not greater than or equal to context.',
        ];
    }
}