<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class StringValidator extends AbstractTypeValidator
{
    /**
     * When value is not a string.
     *
     * @const string
     */
    public const NOT_STRING = 'notString';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_string($value) === true) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_STRING, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_STRING => 'Value must be a string, got \'{{type}}\'.',
        ];
    }
}
