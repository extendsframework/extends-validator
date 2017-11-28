<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Comparison;

use ExtendsFramework\Validator\Result\ResultInterface;

class LessThanValidator extends AbstractComparisonValidator
{
    /**
     * When value is not less than context.
     *
     * @const string
     */
    public const NOT_LESS_THAN = 'notLessThan';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value < $this->subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_LESS_THAN, [
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
            self::NOT_LESS_THAN => 'Value {{value}} is not less than subject {{subject}}.',
        ];
    }
}
