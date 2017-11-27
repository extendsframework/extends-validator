<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\Validator\Result\ResultInterface;

class GreaterThanValidator extends AbstractNumberValidator
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
        $result = parent::validate($value, $context);
        if ($result->isValid() === false) {
            return $result;
        }

        if ($value > $this->number) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_GREATER_THAN, [
            'value' => $value,
            'number' => $this->number,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_GREATER_THAN => 'Value {{value}} is not greater than {{number}}.',
        ];
    }
}
