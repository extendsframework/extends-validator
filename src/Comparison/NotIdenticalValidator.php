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
    public const IS_IDENTICAL = 'isIdentical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value !== $this->subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::IS_IDENTICAL, [
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
            self::IS_IDENTICAL => 'Value {{value}} is identical to subject {{subject}}.',
        ];
    }
}
