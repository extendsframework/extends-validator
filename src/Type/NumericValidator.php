<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class NumericValidator extends AbstractTypeValidator
{
    /**
     * When value is not numeric.
     *
     * @const string
     */
    public const NOT_NUMERIC = 'notNumeric';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_numeric($value) === true) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_NUMERIC, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_NUMERIC => 'Value must be numeric, got {{type}}.',
        ];
    }
}
