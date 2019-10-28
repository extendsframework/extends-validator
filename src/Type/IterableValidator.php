<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Result\ResultInterface;

class IterableValidator extends AbstractTypeValidator
{
    /**
     * When value is not iterable.
     *
     * @const string
     */
    public const NOT_ITERABLE = 'notIterable';

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_iterable($value)) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_ITERABLE, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_ITERABLE => 'Value must be iterable, got {{type}}.',
        ];
    }
}
