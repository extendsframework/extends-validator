<?php
declare(strict_types=1);

namespace ExtendsFramework\Validator\Other\Coordinates;

use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use ExtendsFramework\Validator\AbstractValidator;
use ExtendsFramework\Validator\Object\PropertiesValidator;
use ExtendsFramework\Validator\Other\Coordinates\Coordinate\LatitudeValidator;
use ExtendsFramework\Validator\Other\Coordinates\Coordinate\LongitudeValidator;
use ExtendsFramework\Validator\Result\ResultInterface;

class CoordinatesValidator extends AbstractValidator
{
    /**
     * Latitude object key.
     *
     * @var string
     */
    private $latitude;

    /**
     * Longitude object key.
     *
     * @var string
     */
    private $longitude;

    /**
     * CoordinatesValidator constructor.
     *
     * @param string|null $latitude
     * @param string|null $longitude
     */
    public function __construct(string $latitude = null, string $longitude = null)
    {
        $this->latitude = $latitude ?? 'latitude';
        $this->longitude = $longitude ?? 'longitude';
    }

    /**
     * @inheritDoc
     */
    public static function factory(string $key, ServiceLocatorInterface $serviceLocator, array $extra = null): object
    {
        return new static(
            $extra['latitude'] ?? null,
            $extra['longitude'] ?? null
        );
    }

    /**
     * @inheritDoc
     */
    public function validate($value, $context = null): ResultInterface
    {
        $validator = new PropertiesValidator([
            $this->getLatitude() => new LatitudeValidator(),
            $this->getLongitude() => new LongitudeValidator(),
        ]);

        return $validator->validate($value);
    }

    /**
     * @inheritDoc
     * @codeCoverageIgnore
     */
    protected function getTemplates(): array
    {
        return [];
    }

    /**
     * Get latitude.
     *
     * @return string
     */
    private function getLatitude(): string
    {
        return $this->latitude;
    }

    /**
     * Get longitude.
     *
     * @return string
     */
    private function getLongitude(): string
    {
        return $this->longitude;
    }
}
