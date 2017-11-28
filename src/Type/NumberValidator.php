<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class NumberValidator extends AbstractTypeValidator
{
    /**
     * When value is not a number.
     *
     * @const string
     */
    public const NOT_NUMBER = 'notNumber';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_int($value) === true || is_float($value) === true) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_NUMBER, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_NUMBER => 'Value must be a number, got {{type}}.',
        ];
    }
}
