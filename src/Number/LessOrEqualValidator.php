<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\Validator\Result\ResultInterface;

class LessOrEqualValidator extends AbstractNumberValidator
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
        $result = parent::validate($value, $context);
        if ($result->isValid() === false) {
            return $result;
        }

        if ($value <= $this->number) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_LESS_OR_EQUAL, [
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
            self::NOT_LESS_OR_EQUAL => 'Value {{value}} is not less than or equal to {{number}}.',
        ];
    }
}
