<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Boolean;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\BooleanValidator;

class TrueValidator extends AbstractValidator
{
    /**
     * When value is a boolean, but not true.
     *
     * @var string
     */
    public const NOT_TRUE = 'notTrue';

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static();
    }

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($value, $context = null): ResultInterface
    {
        $result = (new BooleanValidator())->validate($value, $context);
        if (!$result->isValid()) {
            return $result;
        }

        if ($value !== true) {
            return $this->getInvalidResult(self::NOT_TRUE);
        }

        return $this->getValidResult();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_TRUE => 'Value must equals true.',
        ];
    }
}
