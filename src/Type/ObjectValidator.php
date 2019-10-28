<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Type;

use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;

class ObjectValidator extends AbstractTypeValidator
{
    /**
     * When value is not an object.
     *
     * @const string
     */
    public const NOT_OBJECT = 'notObject';

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (is_object($value)) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_OBJECT, [
            'type' => gettype($value),
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_OBJECT => 'Value must be an object, got {{type}}.',
        ];
    }
}
