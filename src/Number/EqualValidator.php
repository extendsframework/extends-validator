<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\Validator\Result\ResultInterface;

class EqualValidator extends AbstractNumberValidator
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
        $result = parent::validate($value, $context);
        if ($result->isValid() === false) {
            return $result;
        }

        /** @noinspection TypeUnsafeComparisonInspection */
        if ($value == $this->number) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_EQUAL, [
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
            self::NOT_EQUAL => 'Value {{value}} is not equal to {{number}}.',
        ];
    }
}
