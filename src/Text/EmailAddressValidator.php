<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\StringValidator;

class EmailAddressValidator extends AbstractValidator
{
    /**
     * When value is not an email address.
     *
     * @const string
     */
    public const NO_EMAIL_ADDRESS = 'noEmailAddress';

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
        $result = (new StringValidator())->validate($value);
        if (!$result->isValid()) {
            return $result;
        }

        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NO_EMAIL_ADDRESS, [
            'value' => $value,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NO_EMAIL_ADDRESS => 'Value {{value}} is not an valid email address.',
        ];
    }
}
