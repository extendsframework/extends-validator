<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\Validator\Result\ResultInterface;

class IdenticalValidator extends AbstractNumberValidator
{
    /**
     * When value is not identical to context.
     *
     * @const string
     */
    public const NOT_IDENTICAL = 'notIdentical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $result = parent::validate($value, $context);
        if ($result->isValid() === false) {
            return $result;
        }

        if ($value === $this->number) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_IDENTICAL, [
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
            self::NOT_IDENTICAL => 'Value {{value}} is not identical to {{number}}.',
        ];
    }
}
