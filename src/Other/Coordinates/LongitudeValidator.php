<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Coordinates;

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
    protected $min = -90;

    /**
     * Maximum longitude value.
     *
     * @var int
     */
    protected $max = 90;

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null)
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function validate($longitude, $context = null): ResultInterface
    {
        $validator = new NumberValidator();
        $result = $validator->validate($longitude);
        if ($result->isValid() === false) {
            return $result;
        }

        if ($longitude < $this->min || $longitude > $this->max) {
            return $this->getInvalidResult(self::LONGITUDE_OUT_OF_BOUND, [
                'min' => $this->min,
                'max' => $this->max,
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
            self::LONGITUDE_OUT_OF_BOUND => 'Longitude is out of bound and must be between {{min}} and {{max}} inclusive, got {{longitude}}.',
        ];
    }
}
