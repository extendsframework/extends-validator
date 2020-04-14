<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use DateTime;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\StringValidator;

class DateTimeValidator extends AbstractValidator
{
    /**
     * When value is not a valid date time notation.
     *
     * @const string
     */
    public const NOT_DATE_TIME = 'notDateTime';

    /**
     * Date time format.
     *
     * @var string
     */
    private $format;

    /**
     * DateTimeValidator constructor.
     *
     * @param string|null $format
     */
    public function __construct(string $format = null)
    {
        $this->format = $format ?? DATE_ATOM;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static(
            $extra['format'] ?? null
        );
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

        $dateTime = DateTime::createFromFormat($this->format, $value);
        if ($dateTime && $dateTime->format($this->format) === $value) {
            return $this->getValidResult();
        }

        return $this->getInvalidResult(self::NOT_DATE_TIME, [
            'value' => $value,
            'format' => $this->format,
        ]);
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::NOT_DATE_TIME => 'Value {{value}} must be a valid date and/of time notation as {{format}}.',
        ];
    }
}
