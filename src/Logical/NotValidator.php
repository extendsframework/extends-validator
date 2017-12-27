<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Logical;

use ExtendsFramework\Validator\Result\ResultInterface;

class NotValidator extends AbstractLogicalValidator
{
    /**
     * When value is not false.
     *
     * @const string
     */
    public const NOT_FALSE = 'notFalse';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ((bool)$value === false) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_FALSE);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_FALSE => 'Value is not equal to false.',
        ];
    }
}
