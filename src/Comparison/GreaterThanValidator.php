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
        if ($value > $this->subject) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_GREATER_THAN, [
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
            self::NOT_GREATER_THAN => 'Value {{value}} is not greater than subject {{subject}}.',
        ];
    }
}
