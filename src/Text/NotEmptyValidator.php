<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\StringValidator;

class NotEmptyValidator extends AbstractValidator
{
    /**
     * When text is and empty string.
     *
     * @var string
     */
    public const EMPTY = 'empty';

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function validate($text, $context = null): ResultInterface
    {
        $validator = new StringValidator();
        $result = $validator->validate($text);
        if ($result->isValid() === false) {
            return $result;
        }

        if (empty($text) === false) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::EMPTY);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::EMPTY => 'Text can not be left empty.',
        ];
    }
}
