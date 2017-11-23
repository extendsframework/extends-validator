<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class EqualValidator extends AbstractComparisonValidator
{
    /**
     * When value is not equal to context.
     *
     * @const string
     */
    public const NOT_EQUAL = 'notEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($value == $context) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_EQUAL);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_EQUAL => 'Value is not equal to context.',
        ];
    }
}
