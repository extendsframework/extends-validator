<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class FloatValidator extends AbstractTypeValidator
{
    /**
     * When value is not a float.
     *
     * @const string
     */
    public const NOT_FLOAT = 'notFloat';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_float($value) === true) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_FLOAT, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_FLOAT => 'Value must be a float, got \'{{type}}\'.',
        ];
    }
}
