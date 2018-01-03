<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Text;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\StringValidator;

class LengthValidator extends AbstractValidator
{
    /**
     * When text is too short.
     *
     * @var string
     */
    public const TOO_SHORT = 'tooShort';

    /**
     * When text is too long.
     *
     * @var string
     */
    public const TOO_LONG = 'tooLong';

    /**
     * When string is not between min and max.
     *
     * @var string
     */
    public const NOT_BETWEEN = 'notBetween';

    /**
     * Minimal length.
     *
     * @var int|null
     */
    protected $min;

    /**
     * Maximum length.
     *
     * @var int|null
     */
    protected $max;

    /**
     * LengthValidator constructor.
     *
     * @param int|null $min
     * @param int|null $max
     */
    public function __construct(int $min = null, int $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static(
            $extra['min'] ?? null,
            $extra['max'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function validate($text, $context = null): ResultInterface
    {
        $result = (new StringValidator())->validate($text);
        if ($result->isValid() === false) {
            return $result;
        }

        $min = $this->getMin();
        $max = $this->getMax();
        $length = strlen($text);
        if (is_int($min) === true && $length < $min) {
            return $this->getInvalidResult(self::TOO_SHORT, [
                'min' => $min,
                'length' => $length,
            ]);
        }
        if (is_int($max) === true && $length > $max) {
            return $this->getInvalidResult(self::TOO_LONG, [
                'max' => $max,
                'length' => $length,
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
            self::TOO_SHORT => 'String length must be at least {{min}} characters, got {{length}}.',
            self::TOO_LONG => 'String length can be up to {{max}} characters, got {{length}}.',
        ];
    }

    /**
     * Get min.
     *
     * @return int|null
     */
    protected function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * Get max.
     *
     * @return int|null
     */
    protected function getMax(): ?int
    {
        return $this->max;
    }
}
