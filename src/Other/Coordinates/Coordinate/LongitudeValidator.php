<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Coordinates\Coordinate;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\NumberValidator;

class LongitudeValidator extends AbstractValidator
{
    /**
     * When longitude is lower than min or greater than max.
     *
     * @var string
     */
    public const LONGITUDE_OUT_OF_BOUND = 'longitudeOutOfBound';

    /**
     * Minimal longitude value.
     *
     * @var int
     */
    private $min = -90;

    /**
     * Maximum longitude value.
     *
     * @var int
     */
    private $max = 90;

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
    public function validate($longitude, $context = null): ResultInterface
    {
        $result = (new NumberValidator())->validate($longitude);
        if (!$result->isValid()) {
            return $result;
        }

        $min = $this->getMin();
        $max = $this->getMax();
        if ($longitude < $min || $longitude > $max) {
            return $this->getInvalidResult(self::LONGITUDE_OUT_OF_BOUND, [
                'min' => $min,
                'max' => $max,
                'longitude' => $longitude,
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
            self::LONGITUDE_OUT_OF_BOUND =>
                'Longitude is out of bound and must be between {{min}} and {{max}} inclusive, got {{longitude}}.',
        ];
    }

    /**
     * Get min.
     *
     * @return int
     */
    private function getMin(): int
    {
        return $this->min;
    }

    /**
     * Get max.
     *
     * @return int
     */
    private function getMax(): int
    {
        return $this->max;
    }
}
