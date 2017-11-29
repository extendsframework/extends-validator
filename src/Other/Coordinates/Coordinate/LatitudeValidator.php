<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Coordinates\Coordinate;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\NumberValidator;

class LatitudeValidator extends AbstractValidator
{
    /**
     * When latitude is lower than min or greater than max.
     *
     * @var string
     */
    public const LATITUDE_OUT_OF_BOUND = 'latitudeOutOfBound';

    /**
     * Minimal latitude value.
     *
     * @var int
     */
    protected $min = -180;

    /**
     * Maximum latitude value.
     *
     * @var int
     */
    protected $max = 180;

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
    public function validate($latitude, $context = null): ResultInterface
    {
        $validator = new NumberValidator();
        $result = $validator->validate($latitude);
        if ($result->isValid() === false) {
            return $result;
        }

        if ($latitude < $this->min || $latitude > $this->max) {
            return $this->getInvalidResult(self::LATITUDE_OUT_OF_BOUND, [
                'min' => $this->min,
                'max' => $this->max,
                'latitude' => $latitude,
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
            self::LATITUDE_OUT_OF_BOUND => 'Latitude is out of bound and must be between {{min}} and {{max}} inclusive, got {{latitude}}.',
        ];
    }
}
