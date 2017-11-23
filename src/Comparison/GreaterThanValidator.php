<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class GreaterThanValidator extends AbstractComparisonValidator
{
    /**
     * When value is not greater than context.
     *
     * @const string
     */
    public const NOT_GREATER_THAN = 'notGreaterThan';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value > $context) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_GREATER_THAN);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_GREATER_THAN => 'Value is not greater than context.',
        ];
    }
}
