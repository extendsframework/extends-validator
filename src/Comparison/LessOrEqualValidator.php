<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class LessOrEqualValidator extends AbstractComparisonValidator
{
    /**
     * When value is not less than or equal to context.
     *
     * @const string
     */
    public const NOT_LESS_OR_EQUAL = 'notLessOrEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value <= $context) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_LESS_OR_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_LESS_OR_EQUAL => 'Value is not less than or equal to context.',
        ];
    }
}
