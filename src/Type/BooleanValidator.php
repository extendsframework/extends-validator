<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class BooleanValidator extends AbstractTypeValidator
{
    /**
     * When value is not a boolean.
     *
     * @const string
     */
    public const NOT_BOOLEAN = 'notBoolean';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_bool($value) === true) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_BOOLEAN, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_BOOLEAN => 'Value must be a boolean, got \'{{type}}\'.',
        ];
    }
}
