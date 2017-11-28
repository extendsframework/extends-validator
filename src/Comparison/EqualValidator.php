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
        if ($value == $this->subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_EQUAL, [
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
            self::NOT_EQUAL => 'Value {{value}} is not equal to subject {{subject}}.',
        ];
    }
}
