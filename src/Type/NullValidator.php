<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;

class NullValidator extends AbstractTypeValidator
{
    /**
     * When value is not null.
     *
     * @const string
     */
    public const NOT_NULL = 'notNull';

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($value, $context = null): ResultInterface
    {
        if ($value === null) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_NULL, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_NULL => 'Value must be null, got {{type}}.',
        ];
    }
}
