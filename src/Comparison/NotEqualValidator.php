<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class NotEqualValidator extends AbstractComparisonValidator
{
    /**
     * When value is not equal to context.
     *
     * @const string
     */
    public const IS_EQUAL = 'isEqual';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($value != $this->subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::IS_EQUAL, [
            'value' => $value,
            'subject' => $this->subject,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::IS_EQUAL => 'Value {{value}} is equal to subject {{subject}}.',
        ];
    }
}
