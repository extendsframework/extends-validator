<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\Validator\Result\ResultInterface;

class NotIdenticalValidator extends AbstractNumberValidator
{
    /**
     * When value is not identical to context.
     *
     * @const string
     */
    public const IS_IDENTICAL = 'identical';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $result = parent::validate($value, $context);
        if ($result->isValid() === false) {
            return $result;
        }

        if ($value !== $this->number) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::IS_IDENTICAL, [
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
            self::IS_IDENTICAL => 'Value {{value}} is identical to {{number}}.',
        ];
    }
}
