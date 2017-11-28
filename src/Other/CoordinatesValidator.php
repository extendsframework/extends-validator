<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Object\PropertiesValidator;
use ExtendsFramework\Validator\Result\Container\ContainerResult;
use ExtendsFramework\Validator\Result\ResultInterface;
use ExtendsFramework\Validator\Type\NumericValidator;

class CoordinatesValidator extends AbstractValidator
{
    /**
     * When latitude is lower than -90 or greater than 90.
     *
     * @var string
     */
    public const LATITUDE_OUT_OF_BOUND = 'latitudeOutOfBound';

    /**
     * When longitude is lower than -180 or greater than 180.
     *
     * @var string
     */
    public const LONGITUDE_OUT_OF_BOUND = 'longitudeOutOfBound';

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): CoordinatesValidator
    {
        return new static();
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $validator = new PropertiesValidator([
            'latitude' => new NumericValidator(),
            'longitude' => new NumericValidator(),
        ]);
        $result = $validator->validate($value);
        if ($result->isValid() === false) {
            return $result;
        }

        $container = new ContainerResult();
        if ($value->latitude < -180 || $value->latitude > 180) {
            $container->addResult(
                $this->getInvalidResult(self::LATITUDE_OUT_OF_BOUND, [
                    'latitude' => $value->latitude,
                ])
            );
        }
        if ($value->longitude < -90 || $value->longitude > 90) {
            $container->addResult(
                $this->getInvalidResult(self::LONGITUDE_OUT_OF_BOUND, [
                    'longitude' => $value->longitude,
                ])
            );
        }

        return $container;
    }

    /**
     * @inheritDoc
     */
    protected function getTemplates(): array
    {
        return [
            self::LATITUDE_OUT_OF_BOUND => 'Latitude is out of bound and must be between -180 and 180 inclusive, got {{latitude}}.',
            self::LONGITUDE_OUT_OF_BOUND => 'Longitude is out of bound and must be between -90 and 90 inclusive, got {{longitude}}.',
        ];
    }
}
