<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class IntegerValidator extends AbstractTypeValidator
{
    /**
     * When value is not an integer.
     *
     * @const string
     */
    public const NOT_INTEGER = 'notInteger';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_int($value) === true) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_INTEGER, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_INTEGER => 'Value must be a integer, got \'{{type}}\'.',
        ];
    }
}
