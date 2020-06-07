<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Collection;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;

class InArrayValidator extends AbstractValidator
{
    /**
     * When value not in array.
     *
     * @var string
     */
    public const NOT_IN_ARRAY = 'notInArray';

    /**
     * Valid values.
     *
     * @var array
     */
    private $values;

    /**
     * InArrayValidator constructor.
     *
     * @param array $values
     */
    public function __construct(array $values)
    {
        $this->values = $values;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static(
            $extra['values'] ?? []
        );
    }

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($value, $context = null): ResultInterface
    {
        if (!in_array($value, $this->values)) {
            return $this->getInvalidResult(self::NOT_IN_ARRAY, [
                'value' => $value,
            ]);
        }

        return $this->getValidResult();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_IN_ARRAY => 'Value {{value}} is not allowed in array.',
        ];
    }
}
