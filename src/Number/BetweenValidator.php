<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Number;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Exception\TemplateNotFound;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\NumericValidator;

class BetweenValidator extends AbstractValidator
{
    /**
     * When number is too low.
     *
     * @var string
     */
    public const TOO_LOW = 'tooLow';

    /**
     * When number is too low or same as min.
     *
     * @var string
     */
    public const TOO_LOW_INCLUSIVE = 'tooLowInclusive';

    /**
     * When number is too high.
     *
     * @var string
     */
    public const TOO_HIGH = 'tooHigh';

    /**
     * When number is too high or same as max.
     *
     * @var string
     */
    public const TOO_HIGH_INCLUSIVE = 'tooHighInclusive';

    /**
     * Minimal number.
     *
     * @var int|null
     */
    private $min;

    /**
     * Maximum number.
     *
     * @var int|null
     */
    private $max;

    /**
     * If min and max are inclusive.
     *
     * @var bool
     */
    private $inclusive;

    /**
     * SizeValidator constructor.
     *
     * @param int|null  $min
     * @param int|null  $max
     * @param bool|null $inclusive
     */
    public function __construct(int $min = null, int $max = null, bool $inclusive = null)
    {
        $this->min = $min;
        $this->max = $max;
        $this->inclusive = $inclusive ?? true;
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static(
            $extra['min'] ?? null,
            $extra['max'] ?? null,
            $extra['inclusive'] ?? null
        );
    }

    /**
     * @inheritDoc
     * @throws TemplateNotFound
     */
    public function validate($number, $context = null): ResultInterface
    {
        $result = (new NumericValidator())->validate($number);
        if (!$result->isValid()) {
            return $result;
        }

        $min = $this->getMin();
        $max = $this->getMax();
        $isInclusive = $this->isInclusive();

        if (is_int($min)) {
            if ($isInclusive) {
                if ($number < $min) {
                    return $this->getInvalidResult(self::TOO_LOW_INCLUSIVE, [
                        'min' => $min,
                        'number' => $number,
                    ]);
                }
            } else {
                if ($number <= $min) {
                    return $this->getInvalidResult(self::TOO_LOW, [
                        'min' => $min,
                        'number' => $number,
                    ]);
                }
            }
        }

        if (is_int($max)) {
            if ($isInclusive) {
                if ($number > $max) {
                    return $this->getInvalidResult(self::TOO_HIGH_INCLUSIVE, [
                        'max' => $max,
                        'number' => $number,
                    ]);
                }
            } else {
                if ($number >= $max) {
                    return $this->getInvalidResult(self::TOO_HIGH, [
                        'max' => $max,
                        'number' => $number,
                    ]);
                }
            }
        }

        return $this->getValidResult();
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::TOO_LOW => 'Number must be greater than or equal to {{min}}, got {{number}}.',
            self::TOO_HIGH => 'Number must be less than or equal to {{max}}, got {{number}}.',
            self::TOO_LOW_INCLUSIVE => 'Number must be greater than {{min}}, got {{number}}.',
            self::TOO_HIGH_INCLUSIVE => 'Number must be less than {{max}}, got {{number}}.',
        ];
    }

    /**
     * Get min.
     *
     * @return int|null
     */
    private function getMin(): ?int
    {
        return $this->min;
    }

    /**
     * Get max.
     *
     * @return int|null
     */
    private function getMax(): ?int
    {
        return $this->max;
    }

    /**
     * Is inclusive.
     *
     * @return bool
     */
    private function isInclusive(): bool
    {
        return $this->inclusive;
    }
}
